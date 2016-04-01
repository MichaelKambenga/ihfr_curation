<?php
/* @var $this UserController */
/* @var $model User */

//$this->breadcrumbs=array(
//	'Users'=>array('index'),
//	$model->id=>array('view','id'=>$model->id),
//	'Update',
//);

?>

<?php //echo TbHtml::pageHeader('','Update User'); ?>

<div class="well">
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>

