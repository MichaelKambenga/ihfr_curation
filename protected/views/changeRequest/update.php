<?php
/* @var $this ChangeRequestController */
/* @var $model ChangeRequest */

$this->breadcrumbs=array(
	'Change Requests'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ChangeRequest', 'url'=>array('index')),
	array('label'=>'Create ChangeRequest', 'url'=>array('create')),
	array('label'=>'View ChangeRequest', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ChangeRequest', 'url'=>array('admin')),
);
?>

<h1>Update ChangeRequest <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>