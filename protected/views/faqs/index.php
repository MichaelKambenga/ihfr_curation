<?php
/* @var $this FaqsController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Faqs',
);

$this->menu=array(
	array('label'=>'Create Faqs','url'=>array('create')),
	array('label'=>'Manage Faqs','url'=>array('admin')),
);
?>

<h1>Faqs</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>