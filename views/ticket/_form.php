<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\TicketType;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Ticket */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ticket-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php 
        $ticketType     = TicketType::find()->all();
        $listDataType   = ArrayHelper::map($ticketType,'id_record','type_name'); 
    ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>    
    
    <?= $form->field($model, 'id_ticket_type')->dropdownList($listDataType); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

