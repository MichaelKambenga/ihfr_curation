<?php
/* @var $this ChangeRequestController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Change Requests',
);

$this->menu=array(
	array('label'=>'Create ChangeRequest', 'url'=>array('create')),
	array('label'=>'Manage ChangeRequest', 'url'=>array('admin')),
);
?>

<h1>Change Requests</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
