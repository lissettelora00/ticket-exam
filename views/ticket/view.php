<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\TicketStatus;
use app\models\TicketType;
use app\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\Ticket */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Tickets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="ticket-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_record], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_record], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_record',
            'title',
            'description:ntext',
            //'id_user_requestor',
            [
                'attribute' => 'id_user_requestor',
                'value' => function ($dataProvider) {
                    $user   = User::findOne($dataProvider->id_user_requestor);
                    return $user->first_name." ".$user->last_name; 
                },
            ],
            //'id_ticket_type',
            [
                'attribute' => 'id_ticket_type',
                'value' => function ($dataProvider) {
                    $ticketType   = TicketType::findOne($dataProvider->id_ticket_type);
                    return $ticketType->type_name; 
                },
            ],
            'request_date',
            //'id_ticket_status',
            [
                'attribute' => 'id_ticket_status',
                'value' => function ($dataProvider) {
                    $ticketStatus   = TicketStatus::findOne($dataProvider->id_ticket_status);
                    return $ticketStatus->status_name; 
                },
            ],
        ],
    ]) ?>

</div>
