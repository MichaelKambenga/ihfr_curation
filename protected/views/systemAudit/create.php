<?php
$this->breadcrumbs=array(
	'System Audits'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SystemAudit', 'url'=>array('index')),
	array('label'=>'Manage SystemAudit', 'url'=>array('admin')),
);
?>

<h1>Create SystemAudit</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>