<?php
/* @var $this ChangeRequestNoteController */
/* @var $model ChangeRequestNote */

$this->breadcrumbs=array(
	'Change Request Notes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ChangeRequestNote', 'url'=>array('index')),
	array('label'=>'Manage ChangeRequestNote', 'url'=>array('admin')),
);
?>

<h1>Create ChangeRequestNote</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>