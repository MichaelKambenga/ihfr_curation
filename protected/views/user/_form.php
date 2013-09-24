<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'user-form',
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <!--	<div class="row">
    <?php echo $form->labelEx($model, 'id'); ?>
    <?php echo $form->textField($model, 'id'); ?>
    <?php echo $form->error($model, 'id'); ?>
            </div>-->

    <div class="row">
        <?php echo $form->labelEx($model, 'position_id'); ?>
        <?php //echo $form->textField($model,'position_id'); ?>
        <?php echo $form->dropDownList($model, 'position_id', CHtml::listData(Position::model()->findAll(), 'id', 'position_name'), array('empty' => '--Select Position--')); ?>
        <?php echo $form->error($model, 'position_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'organization_id'); ?>
        <?php //echo $form->textField($model, 'organization_id'); ?>
        <?php echo $form->dropDownList($model, 'organization_id', CHtml::listData(Organization::model()->findAll(), 'id', 'organization_name'), array('empty' => '--Select Organization--')); ?>
        <?php echo $form->error($model, 'organization_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'email'); ?>
        <?php echo $form->textField($model, 'email', array('size' => 45, 'maxlength' => 45)); ?>
        <?php echo $form->error($model, 'email'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-primary')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->