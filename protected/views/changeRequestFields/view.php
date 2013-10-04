<?php
/* @var $this ChangeRequestFieldsController */
/* @var $model ChangeRequestFields */

$this->breadcrumbs=array(
	'Change Request Fields'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ChangeRequestFields', 'url'=>array('index')),
	array('label'=>'Create ChangeRequestFields', 'url'=>array('create')),
	array('label'=>'Update ChangeRequestFields', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ChangeRequestFields', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ChangeRequestFields', 'url'=>array('admin')),
);
?>

<h1>View ChangeRequestFields #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'change_request_id',
		'field_id',
	),
)); ?>
