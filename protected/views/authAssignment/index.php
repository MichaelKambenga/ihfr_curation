<?php
$this->breadcrumbs=array(
	'Auth Assignments',
);

$this->menu=array(
	array('label'=>'Create AuthAssignment', 'url'=>array('create')),
	array('label'=>'Manage AuthAssignment', 'url'=>array('admin')),
);
?>

<h1>Auth Assignments</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
