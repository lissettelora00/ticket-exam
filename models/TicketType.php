<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ticket_type".
 *
 * @property int $id_record
 * @property string $type_name
 * @property string $description
 * @property int $active
 */
class TicketType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ticket_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type_name', 'description'], 'required'],
            [['active'], 'integer'],
            [['type_name'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_record' => 'Id Record',
            'type_name' => 'Type Name',
            'description' => 'Description',
            'active' => 'Active',
        ];
    }
}
