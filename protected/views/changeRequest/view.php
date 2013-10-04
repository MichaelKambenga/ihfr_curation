<?php
/* @var $this ChangeRequestController */
/* @var $model ChangeRequest */

$this->breadcrumbs=array(
	'Change Requests'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ChangeRequest', 'url'=>array('index')),
	array('label'=>'Create ChangeRequest', 'url'=>array('create')),
	array('label'=>'Update ChangeRequest', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ChangeRequest', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ChangeRequest', 'url'=>array('admin')),
);
?>

<h1>View ChangeRequest #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'primary_site_code',
		'cc_site_id',
		'version_id',
		'requested_by',
		'request_type',
		'status',
		'requested_date',
		'reviewed_date',
		'reviewed_by',
	),
)); ?>
