<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\TicketType;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Ticket */
/* @var $form yii\widgets\ActiveForm */
?>
<section class="content">
    <div class="ticket-form row">
        <div class="col-md-8">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
                </div>
                <?php $form = ActiveForm::begin(); ?>

                <?php 
                    $ticketType     = TicketType::find()->all();
                    $listDataType   = ArrayHelper::map($ticketType,'id_record','type_name'); 
                ?>
                <div class="box-body">
                    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>    
                    
                    <?= $form->field($model, 'id_ticket_type')->dropdownList($listDataType); ?>

                    <div class="form-group">
                        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                    </div>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</section>

