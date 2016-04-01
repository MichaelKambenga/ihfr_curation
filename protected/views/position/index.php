<?php
/* @var $this PositionController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Positions',
);

$this->menu=array(
	array('label'=>'Create Position','url'=>array('create')),
	array('label'=>'Manage Position','url'=>array('admin')),
);
?>

<h1>Positions</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>