<?php
/* @var $this FieldMappingController */
/* @var $model FieldMapping */

$this->breadcrumbs=array(
	'Field Mappings'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List FieldMapping', 'url'=>array('index')),
	array('label'=>'Manage FieldMapping', 'url'=>array('admin')),
);
?>

<h1>Create FieldMapping</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>