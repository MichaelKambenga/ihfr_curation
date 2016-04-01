<?php
$this->breadcrumbs=array(
	'System Audits'=>array('index'),
	$model->auditId,
);

$this->menu=array(
	array('label'=>'List SystemAudit', 'url'=>array('index')),
	array('label'=>'Create SystemAudit', 'url'=>array('create')),
	array('label'=>'Update SystemAudit', 'url'=>array('update', 'id'=>$model->auditId)),
	array('label'=>'Delete SystemAudit', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->auditId),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SystemAudit', 'url'=>array('admin')),
);
?>

<h1>View SystemAudit #<?php echo $model->auditId; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'auditId',
		'userId',
		'action',
		'date',
	),
)); ?>
