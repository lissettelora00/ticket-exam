<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ticket".
 *
 * @property int $id_record
 * @property string $title
 * @property string $description
 * @property int $id_user_requestor
 * @property int $id_ticket_type
 * @property string $request_date
 * @property int $id_ticket_status
 */
class Ticket extends \yii\db\ActiveRecord
{
    //automatic/default status 
    const TICKET_OPEN       = 1;
    const TICKET_ASSIGNED   = 2;
    const TICKET_PENDING    = 3;
    //manual status
    const TICKET_CANCELLED  = 4;
    const TICKET_FINISHED   = 5;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ticket';
    }

    public static function primaryKey()
    {
        return ['id_record'];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description', 'id_user_requestor', 'id_ticket_type', 'request_date'], 'required'],
            [['id_user_requestor', 'id_ticket_type', 'id_ticket_status'], 'integer'],
            [['description'], 'string'],
            [['request_date'], 'safe'],
            [['title'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_record' => 'Id',
            'title' => 'Title',
            'description' => 'Description',
            'id_user_requestor' => 'Requestor',
            'id_ticket_type' => 'Ticket Type',
            'request_date' => 'Request Date',
            'id_ticket_status' => 'Ticket Status',
        ];
    }

    /**
     * Search all tickets with its information by a range of date
     */
    public function getCurrentUserTickets()
    {
        $loggedUser = Yii::$app->user->identity->id;

        $query      = " SELECT 
                            t.*, SUM(td.worked_time) AS worked
                        FROM `assigned_ticket` ati 
                        INNER JOIN `ticket` t ON (ati.id_ticket = t.id_record)
                        INNER JOIN `ticket_detail` td ON (td.id_ticket = ati.id_ticket) 
                        WHERE TRUE
                        AND ati.id_user_assigned = $loggedUser
                        GROUP BY td.id_ticket
                    ";
        
        $allTickets = Yii::$app->db
                        ->createCommand($query)
                        ->queryAll();
        
        return $allTickets;
    }


    /**
     * Search all tickets with its information by a range of date
     */
    public function getTicketReportByDate($initialDate, $finalDate)
    {
        $open      = TICKET::TICKET_OPEN;
        $assigned  = TICKET::TICKET_ASSIGNED;
        $pending   = TICKET::TICKET_PENDING;
        $cancelled = TICKET::TICKET_CANCELLED;
        $finished  = TICKET::TICKET_FINISHED;

        $current_user = Yii::$app->user->identity->id;
       
        $query  = " SELECT  
                        t.*, 
                        GETUSERNAMEBYID(t.id_user_requestor)  AS requestor, 
                        GETUSERNAMEBYID(ati.id_user_assigned) AS assigned,  
                        COALESCE(SUM(td.worked_time), 0)      AS worked, 
                        ts.status_name,
                        ( 
                            IF (id_ticket_status = $open, 'blue',
                                IF (id_ticket_status = $assigned, 'yellow',
                                    IF (id_ticket_status = $pending, 'orange',
                                        IF (id_ticket_status = $cancelled, 'red',
                                            IF (id_ticket_status = $finished, 'green',
                                                'grey'
                                            )
                                        )
                                    )
                                )
                            )
                        ) AS status_color,
                        ( 
                            IF (id_ticket_status = $open, 'ticket/unassigned',
                                IF (id_ticket_status = $assigned && ati.id_user_assigned = $current_user, 'ticket/pending',
                                    IF (id_ticket_status = $assigned, 'ticket/index',
                                        IF (id_ticket_status = $pending && ati.id_user_assigned = $current_user, 'ticket/pending',
                                            IF (id_ticket_status = $pending, 'ticket/pending',    
                                                IF (id_ticket_status = $cancelled, 'ticket/index',
                                                    IF (id_ticket_status = $finished, 'ticket/index',
                                                        'ticket/index'
                                                    )
                                                )
                                            )
                                        )
                                    )
                                )
                            )
                        ) AS link                          
                    FROM ticket t
                        LEFT JOIN assigned_ticket ati ON (ati.id_ticket = t.id_record)
                        LEFT JOIN user u ON (u.id_record = ati.id_user_assigned)
                        INNER JOIN ticket_status ts ON (ts.id_record = t.id_ticket_status)
                        LEFT  JOIN ticket_detail td ON (td.id_ticket = t.id_record)
                    WHERE TRUE
                        AND t.request_date BETWEEN '$initialDate' AND '$finalDate'
                    GROUP BY t.id_record
                    ORDER BY t.id_record
                ";

        $command = Yii::$app->db->createCommand($query);
        $result  = $command->queryAll();

        return $result;
    }
    
}

