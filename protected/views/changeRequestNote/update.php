<?php
/* @var $this ChangeRequestNoteController */
/* @var $model ChangeRequestNote */

$this->breadcrumbs=array(
	'Change Request Notes'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ChangeRequestNote', 'url'=>array('index')),
	array('label'=>'Create ChangeRequestNote', 'url'=>array('create')),
	array('label'=>'View ChangeRequestNote', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ChangeRequestNote', 'url'=>array('admin')),
);
?>

<h1>Update ChangeRequestNote <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>