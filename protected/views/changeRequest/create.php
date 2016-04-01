<?php
/* @var $this ChangeRequestController */
/* @var $model ChangeRequest */

$this->breadcrumbs=array(
	'Change Requests'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ChangeRequest', 'url'=>array('index')),
	array('label'=>'Manage ChangeRequest', 'url'=>array('admin')),
);
?>

<h1>Create ChangeRequest</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>