<?php
$this->breadcrumbs=array(
	'Groups'=>array('roles'),
	'Assign',
);
?>
<h1>Add Actions/Operations to the Group/Role:- <?php echo $name; ?></h1>

<?php if(Yii::app()->user->hasFlash('success')):?>
<div >
      <p class="success"><?php echo Yii::app()->user->getFlash('success');?></p>
</div>
      <?php endif;?>

<?php if(Yii::app()->user->hasFlash('failure')):?>
<div >
      <p class="failure"><?php echo Yii::app()->user->getFlash('failure');?></p>
</div>
<?php endif;?>

<?php echo CHtml::beginForm('', 'POST', array('id' => 'auth-id-form')); ?>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'auth-id-grid',
    'dataProvider' => $dataProvider,
    'selectableRows' => 2, // multiple rows can be selected
    'ajaxUpdate' => false,
    'columns' => array(
        array(
            'class' => 'CCheckBoxColumn',
            'id' => 'name[]',
            //'checked'=>true?'checked':'',
           'checked' => 'AuthItemChild::isAssigned('.'$data->name'.', "'.$name.'")',
        ),
        'name',
        'description',
    ),
));
?>
<?php echo CHtml::submitButton('Assign');?>
<?php echo CHtml::endForm(); ?>
