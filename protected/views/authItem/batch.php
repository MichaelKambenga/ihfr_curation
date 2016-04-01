<?php
$this->breadcrumbs=array(
	'Groups'=>array('roles'),
	'Assign',
);
?>

<?php echo TbHtml::pageHeader('', 'Add Actions/Operations to the Group/Role '."({$name})"); ?>

<div class="well">
<?php if(Yii::app()->user->hasFlash('success')):?>
<div class="alert alert-success">
      <?php echo Yii::app()->user->getFlash('success');?>
</div>
      <?php endif;?>

<?php if(Yii::app()->user->hasFlash('info')):?>
<div class="alert alert-info">
      <?php echo Yii::app()->user->getFlash('info');?>
</div>
<?php endif;?>
    
    
<?php if(Yii::app()->user->hasFlash('failure')):?>
<div class="alert alert-error">
      <?php echo Yii::app()->user->getFlash('failure');?>
</div>
<?php endif;?>

<?php echo CHtml::beginForm('', 'POST', array('id' => 'auth-id-form')); ?>

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>  TbHtml::GRID_TYPE_BORDERED,
    'id' => 'auth-id-grid',
    'dataProvider' => $dataProvider,
    'selectableRows' => 2, // multiple rows can be selected
    'ajaxUpdate' => false,
    'columns' => array(
        array(
            'class' => 'CCheckBoxColumn',
            'id' => 'name[]',
            'checked' => 'AuthItemChild::isAssigned('.'$data->name'.', "'.$name.'")',
            'value'=>'$data->name',
        ),
        'name',
        'description',
    ),
));
?>
<?php echo CHtml::submitButton('Assign', array('class'=>'btn btn-primary','name'=>'submit'));?>

<?php echo CHtml::endForm(); ?>

</div>