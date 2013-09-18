

<div class="form wide">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'auth-item-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'type'); ?>
		<?php //echo $form->textField($model,'type'); ?>
                <?php echo $form->hiddenField($model, 'type', array('value' => 2));?>
		<?php echo $form->error($model,'type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('style'=>'width:400px;height:100px;')); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'bizrule'); ?>
		<?php //echo $form->textArea($model,'bizrule',array('rows'=>6, 'cols'=>50)); ?>
		<?php //echo $form->error($model,'bizrule'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'data'); ?>
		<?php// echo $form->textArea($model,'data',array('rows'=>6, 'cols'=>50)); ?>
		<?php //echo $form->error($model,'data'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->