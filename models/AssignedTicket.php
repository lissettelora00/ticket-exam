<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "assigned_ticket".
 *
 * @property int $id_record
 * @property int $id_user_assigned
 * @property int $id_ticket
 * @property int $id_user_assigns_ticket
 * @property string $assigned_date
 */
class AssignedTicket extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'assigned_ticket';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user_assigned', 'id_ticket', 'id_user_assigns_ticket'], 'required'],
            [['id_user_assigned', 'id_ticket', 'id_user_assigns_ticket'], 'integer'],
            [['assigned_date'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_record' => 'Id Record',
            'id_user_assigned' => 'Id User Assigned',
            'id_ticket' => 'Id Ticket',
            'id_user_assigns_ticket' => 'Id User Assigns Ticket',
            'assigned_date' => 'Assigned Date',
        ];
    }
}
