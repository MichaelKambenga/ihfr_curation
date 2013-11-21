<?php
/* @var $this FieldMappingController */
/* @var $model FieldMapping */

$this->breadcrumbs=array(
	'Field Mappings'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List FieldMapping', 'url'=>array('index')),
	array('label'=>'Create FieldMapping', 'url'=>array('create')),
	array('label'=>'View FieldMapping', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage FieldMapping', 'url'=>array('admin')),
);
?>

<h1>Update FieldMapping <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>