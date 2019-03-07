<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TicketDetail */

$this->title = 'Update Ticket Detail: ' . $model->id_record;
$this->params['breadcrumbs'][] = ['label' => 'Ticket Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_record, 'url' => ['view', 'id' => $model->id_record]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ticket-detail-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
