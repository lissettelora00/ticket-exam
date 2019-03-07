<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AssignedTicket */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="assigned-ticket-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_user_assigned')->textInput() ?>

    <?= $form->field($model, 'id_ticket')->textInput() ?>

    <?= $form->field($model, 'id_user_assigns_ticket')->textInput() ?>

    <?= $form->field($model, 'assigned_date')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
