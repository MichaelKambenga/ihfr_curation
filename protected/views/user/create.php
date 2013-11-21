<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Create',
);
?>

<?php echo TbHtml::pageHeader('','Create User'); ?>

<div class="well">
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>