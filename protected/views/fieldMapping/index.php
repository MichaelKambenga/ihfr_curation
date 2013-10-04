<?php
/* @var $this FieldMappingController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Field Mappings',
);

$this->menu=array(
	array('label'=>'Create FieldMapping', 'url'=>array('create')),
	array('label'=>'Manage FieldMapping', 'url'=>array('admin')),
);
?>

<h1>Field Mappings</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
