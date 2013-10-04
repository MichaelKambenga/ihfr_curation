<?php
/* @var $this ChangeRequestFieldsController */
/* @var $model ChangeRequestFields */

$this->breadcrumbs=array(
	'Change Request Fields'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ChangeRequestFields', 'url'=>array('index')),
	array('label'=>'Manage ChangeRequestFields', 'url'=>array('admin')),
);
?>

<h1>Create ChangeRequestFields</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>