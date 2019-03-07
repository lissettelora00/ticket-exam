<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AssignedTicket */

$this->title = 'Update Assigned Ticket: ' . $model->id_record;
$this->params['breadcrumbs'][] = ['label' => 'Assigned Tickets', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_record, 'url' => ['view', 'id' => $model->id_record]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="assigned-ticket-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
