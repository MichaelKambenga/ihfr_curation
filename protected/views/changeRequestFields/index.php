<?php
/* @var $this ChangeRequestFieldsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Change Request Fields',
);

$this->menu=array(
	array('label'=>'Create ChangeRequestFields', 'url'=>array('create')),
	array('label'=>'Manage ChangeRequestFields', 'url'=>array('admin')),
);
?>

<h1>Change Request Fields</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
