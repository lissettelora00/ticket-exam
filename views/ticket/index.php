<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\TicketStatus;
use app\models\TicketType;
use app\models\User;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TicketSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tickets';
//$this->params['breadcrumbs'][] = $this->title;

?>
<div class="ticket-index">
    <section class="content-header">
        <h1>
            <?= Html::encode($this->title) ?>
            <small>All</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
            <li><a href="<?= Url::toRoute('ticket/index'); ?>">Tickets</a></li>
            <li class="active">Unassigned</li>
        </ol>
    </section>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <section class="content">
    <p>
        <?= Html::a('Create Ticket', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

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
            [
                'attribute' => 'id_ticket_type',
                'value' => function ($dataProvider) {
                    $ticketType   = TicketType::findOne($dataProvider->id_ticket_type);
                    return $ticketType->type_name; 
                },
            ],
            'request_date',
            [
                'attribute' => 'id_ticket_status',
                'value' => function ($dataProvider) {
                    $ticketStatus   = TicketStatus::findOne($dataProvider->id_ticket_status);
                    return $ticketStatus->status_name; 
                },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    </section>
</div>
