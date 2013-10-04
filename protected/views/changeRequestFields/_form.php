<?php
/* @var $this ChangeRequestFieldsController */
/* @var $model ChangeRequestFields */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'change-request-fields-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id'); ?>
		<?php echo $form->textField($model,'id',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'change_request_id'); ?>
		<?php echo $form->textField($model,'change_request_id'); ?>
		<?php echo $form->error($model,'change_request_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'field_id'); ?>
		<?php echo $form->textField($model,'field_id'); ?>
		<?php echo $form->error($model,'field_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->