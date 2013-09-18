<?php
$this->breadcrumbs=array(
	'Auth Assignments'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List AuthAssignment', 'url'=>array('index')),
	array('label'=>'Manage AuthAssignment', 'url'=>array('admin')),
);
?>

<h1>Create AuthAssignment</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>