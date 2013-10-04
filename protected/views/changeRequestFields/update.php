<?php
/* @var $this ChangeRequestFieldsController */
/* @var $model ChangeRequestFields */

$this->breadcrumbs=array(
	'Change Request Fields'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ChangeRequestFields', 'url'=>array('index')),
	array('label'=>'Create ChangeRequestFields', 'url'=>array('create')),
	array('label'=>'View ChangeRequestFields', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ChangeRequestFields', 'url'=>array('admin')),
);
?>

<h1>Update ChangeRequestFields <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>