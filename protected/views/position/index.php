<?php
/* @var $this PositionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Positions',
);

$this->menu=array(
	array('label'=>'Create Position', 'url'=>array('create')),
	array('label'=>'Manage Position', 'url'=>array('admin')),
);
?>

<h1>Positions</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
