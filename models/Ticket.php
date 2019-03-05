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
            [['id_user_requestor'], 'default', 'value'=>Yii::$app->user->id],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_record' => 'Id Record',
            'title' => 'Title',
            'description' => 'Description',
            'id_user_requestor' => 'Id User Requestor',
            'id_ticket_type' => 'Id Ticket Type',
            'request_date' => 'Request Date',
            'id_ticket_status' => 'Id Ticket Status',
        ];
    }
}