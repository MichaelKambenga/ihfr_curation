<?php
$this->breadcrumbs=array(
	'System Audits'=>array('index'),
	$model->auditId=>array('view','id'=>$model->auditId),
	'Update',
);

$this->menu=array(
	array('label'=>'List SystemAudit', 'url'=>array('index')),
	array('label'=>'Create SystemAudit', 'url'=>array('create')),
	array('label'=>'View SystemAudit', 'url'=>array('view', 'id'=>$model->auditId)),
	array('label'=>'Manage SystemAudit', 'url'=>array('admin')),
);
?>

<h1>Update SystemAudit <?php echo $model->auditId; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>