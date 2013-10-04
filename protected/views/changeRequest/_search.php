<?php
/* @var $this ChangeRequestController */
/* @var $model ChangeRequest */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'primary_site_code'); ?>
		<?php echo $form->textField($model,'primary_site_code',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cc_site_id'); ?>
		<?php echo $form->textField($model,'cc_site_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'version_id'); ?>
		<?php echo $form->textField($model,'version_id',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'requested_by'); ?>
		<?php echo $form->textField($model,'requested_by'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'request_type'); ?>
		<?php echo $form->textField($model,'request_type',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status'); ?>
		<?php echo $form->textField($model,'status',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'requested_date'); ?>
		<?php echo $form->textField($model,'requested_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'reviewed_date'); ?>
		<?php echo $form->textField($model,'reviewed_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'reviewed_by'); ?>
		<?php echo $form->textField($model,'reviewed_by'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->