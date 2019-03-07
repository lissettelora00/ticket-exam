<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ticket_detail".
 *
 * @property int $id_record
 * @property int $id_ticket
 * @property string $comment
 * @property double $worked_time
 * @property int $id_ticket_status_user
 */
class TicketDetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ticket_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_ticket', 'comment', 'worked_time', 'id_ticket_status_user'], 'required'],
            [['id_ticket', 'id_ticket_status_user'], 'integer'],
            [['comment'], 'string'],
            [['worked_time'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_record' => 'Id Record',
            'id_ticket' => 'Id Ticket',
            'comment' => 'Comment',
            'worked_time' => 'Worked Time',
            'id_ticket_status_user' => 'Id Ticket Status User',
        ];
    }
}
