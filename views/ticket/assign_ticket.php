<?php
  use yii\helpers\Html;
  use yii\bootstrap\ActiveForm;

  $form = ActiveForm::begin([
            'enableClientValidation' => true,
            'options' => ['id'      => 'dynamic-form']
          ]);
?>

<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal">&times;</button>
  <h4 class="modal-title">Add Comment</h4>
</div>

<div class="modal-body">
      <?php echo $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
      <?php echo $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
      <?php echo $form->field($model, 'comment')->textArea() ?>
</div>

<div class="modal-footer">
  <?php echo Html::submitButton(Yii::t('backend', 'Send'), ['class' => 'btn btn-success']) ?>
  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>

<?php ActiveForm::end(); ?>