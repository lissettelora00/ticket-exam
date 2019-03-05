<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Ticket */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ticket-form">

    <?php $form = ActiveForm::begin(); ?>

    

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'id_user_requestor')->textInput() ?>

    <?= $form->field($model, 'id_ticket_type')->dropdownList([
        1 => 'checkbox 1', 
        2 => 'checkbox 2']) 
    ?>

    <?= $form->field($model, 'request_date')->textInput(['value' => '5']) ?>

    <?= $form->field($model, 'id_ticket_status')->dropdownList([
        1 => 'checkbox 1', 
        2 => 'checkbox 2']) 
    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
