<?php
/* @var $this FieldMappingController */
/* @var $model FieldMapping */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'field-mapping-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'cc_field_id'); ?>
		<?php echo $form->textField($model,'cc_field_id',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'cc_field_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pc_field_id'); ?>
		<?php echo $form->textField($model,'pc_field_id',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'pc_field_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'semantics'); ?>
		<?php echo $form->textField($model,'semantics',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'semantics'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->