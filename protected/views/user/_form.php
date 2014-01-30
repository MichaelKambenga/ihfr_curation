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

    <div class="row">
        <?php echo $form->labelEx($model, 'email'); ?>
        <?php echo $form->textField($model, 'email', array('size' => 45, 'maxlength' => 45)); ?>
        <?php echo $form->error($model, 'email'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'firstname'); ?>
        <?php echo $form->textField($model, 'firstname', array('size' => 45, 'maxlength' => 45)); ?>
        <?php echo $form->error($model, 'firstname'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'lastname'); ?>
        <?php echo $form->textField($model, 'lastname', array('size' => 45, 'maxlength' => 45)); ?>
        <?php echo $form->error($model, 'lastname'); ?>
    </div>

    <div class="row">
        <?php //echo $form->labelEx($model, 'node_id'); ?>
        <?php //echo $form->textField($model, 'node_id', array('size' => 45, 'maxlength' => 45)); ?>
        <?php //echo $form->error($model, 'node_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'position_id'); ?>
        <?php echo $form->dropDownList($model, 'position_id', CHtml::listData(Position::model()->findAll(), 'id', 'position_name'), array('empty' => '--Select Position--')); ?>
        <?php echo $form->error($model, 'position_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'organization_id'); ?>
        <?php echo $form->dropDownList($model, 'organization_id', CHtml::listData(Organization::model()->findAll(), 'id', 'organization_name'), array('empty' => '--Select Organization--')); ?>
        <?php echo $form->error($model, 'organization_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'phone_number'); ?>
        <?php echo $form->textField($model, 'phone_number', array('size' => 45, 'maxlength' => 45)); ?>
        <?php echo $form->error($model, 'phone_number'); ?>
    </div>
    <div class="row">
       
    <?php 
        $data = array();
        $options = Layer::getAreaOptions();
        foreach($options['zones'] as $option){
            $data[$option['id']] = $option['name'];
        }
        echo TbHtml::label('Zone', 'zone');
        echo TbHtml::dropDownListControlGroup('zone', '', $data,array('prompt'=>'--Please select--'));
    ?>
                       
    </div>
    <div class="row">
       
    <?php 
        $data = array();
        $options = Layer::getAreaOptions();
        foreach($options['regions'] as $option){
            $data[$option['id']] = $option['name'];
        }
        echo TbHtml::label('Region','region');
        echo TbHtml::dropDownListControlGroup('region', '', $data,array('prompt'=>'--Please select--'));
    ?>
                       
    </div>
    
    <div class="row">
       
    <?php 
        $data = array();
        $options = Layer::getAreaOptions();
        foreach($options['districts'] as $option){
            $data[$option['id']] = $option['name'];
        }
        echo TbHtml::label('District', 'node_id');
        echo TbHtml::activeDropDownList($model, 'node_id',$data,array('prompt'=>'--Please select--'));
    ?>
                       
    </div>
    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn btn-info')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->



    