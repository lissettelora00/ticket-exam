<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AssignedTicket */

$this->title = 'Create Assigned Ticket';
$this->params['breadcrumbs'][] = ['label' => 'Assigned Tickets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="assigned-ticket-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
