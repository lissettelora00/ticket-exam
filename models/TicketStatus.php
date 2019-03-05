<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ticket_status".
 *
 * @property int $id_record
 * @property string $status_name
 * @property string $description
 */
class TicketStatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ticket_status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status_name'], 'required'],
            [['description'], 'string'],
            [['status_name'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_record' => 'Id Record',
            'status_name' => 'Status Name',
            'description' => 'Description',
        ];
    }
}
