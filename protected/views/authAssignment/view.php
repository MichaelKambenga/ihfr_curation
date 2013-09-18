<?php
$this->breadcrumbs=array(
	'Auth Assignments'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List AuthAssignment', 'url'=>array('index')),
	array('label'=>'Create AuthAssignment', 'url'=>array('create')),
	array('label'=>'Update AuthAssignment', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete AuthAssignment', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage AuthAssignment', 'url'=>array('admin')),
);
?>

<h1>View AuthAssignment #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'itemname',
		'userid',
		'bizrule',
		'data',
	),
)); ?>
