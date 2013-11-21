<?php
/* @var $this FieldMappingController */
/* @var $model FieldMapping */

$this->breadcrumbs=array(
	'Field Mappings'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List FieldMapping', 'url'=>array('index')),
	array('label'=>'Create FieldMapping', 'url'=>array('create')),
	array('label'=>'Update FieldMapping', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete FieldMapping', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage FieldMapping', 'url'=>array('admin')),
);
?>

<h1>View FieldMapping #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'cc_field_id',
		'pc_field_id',
		'semantics',
	),
)); ?>
