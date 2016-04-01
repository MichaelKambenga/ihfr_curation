<?php
$this->breadcrumbs=array(
	'System Audits',
);

$this->menu=array(
	array('label'=>'Create SystemAudit', 'url'=>array('create')),
	array('label'=>'Manage SystemAudit', 'url'=>array('admin')),
);
?>

<h1>System Audits</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
