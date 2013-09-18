<?php
$this->breadcrumbs=array(
	'Groups'=>array('roles'),
	'Create',
);
?>

<?php echo TbHtml::pageHeader('','Create Group'); ?>

<div class="well">
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>