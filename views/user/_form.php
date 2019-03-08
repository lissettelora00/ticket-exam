<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<section class="content">
    <div class="ticket-form row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">

                <div class="user-form">

                    <?php $form = ActiveForm::begin(); ?>

                    <div class="box-body">

                        <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'active')->dropdownList([1=>'true', 0 => 'false']) ?>

                        <div class="form-group">
                            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                        </div>

                    </div>

                    <?php ActiveForm::end(); ?>
                </div>

            </div>
        </div>
    </div>
</section>
