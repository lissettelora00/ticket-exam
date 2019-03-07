<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Assigned Tickets';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="assigned-ticket-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Assigned Ticket', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_record',
            'id_user_assigned',
            'id_ticket',
            'id_user_assigns_ticket',
            'assigned_date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
