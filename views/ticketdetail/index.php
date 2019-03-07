<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ticket Details';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ticket-detail-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Ticket Detail', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_record',
            'id_ticket',
            'comment:ntext',
            'worked_time',
            'id_ticket_status_user',
            //'updated_datetime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
