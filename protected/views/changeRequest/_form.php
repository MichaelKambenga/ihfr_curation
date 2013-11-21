<?php
/* @var $this ChangeRequestController */
/* @var $model ChangeRequest */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'change-request-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'primary_site_code'); ?>
		<?php echo $form->textField($model,'primary_site_code',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'primary_site_code'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cc_site_id'); ?>
		<?php echo $form->textField($model,'cc_site_id'); ?>
		<?php echo $form->error($model,'cc_site_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'version_id'); ?>
		<?php echo $form->textField($model,'version_id',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'version_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'requested_by'); ?>
		<?php echo $form->textField($model,'requested_by'); ?>
		<?php echo $form->error($model,'requested_by'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'request_type'); ?>
		<?php echo $form->textField($model,'request_type',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'request_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model,'status',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'requested_date'); ?>
		<?php echo $form->textField($model,'requested_date'); ?>
		<?php echo $form->error($model,'requested_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'reviewed_date'); ?>
		<?php echo $form->textField($model,'reviewed_date'); ?>
		<?php echo $form->error($model,'reviewed_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'reviewed_by'); ?>
		<?php echo $form->textField($model,'reviewed_by'); ?>
		<?php echo $form->error($model,'reviewed_by'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->