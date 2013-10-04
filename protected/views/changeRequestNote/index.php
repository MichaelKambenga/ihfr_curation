<?php
/* @var $this ChangeRequestNoteController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Change Request Notes',
);

$this->menu=array(
	array('label'=>'Create ChangeRequestNote', 'url'=>array('create')),
	array('label'=>'Manage ChangeRequestNote', 'url'=>array('admin')),
);
?>

<h1>Change Request Notes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
