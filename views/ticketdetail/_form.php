<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TicketDetail */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ticket-detail-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_ticket')->textInput() ?>

    <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'worked_time')->textInput() ?>

    <?= $form->field($model, 'id_ticket_status_user')->textInput() ?>

    <?= $form->field($model, 'updated_datetime')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
