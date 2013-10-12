
<?php
$this->breadcrumbs=array(
	'Sites'=>array('facilities'),
	'Create',
);
?>

<?php echo TbHtml::pageHeader('','Create Site'); ?>

<div class="well">
  <?php if(Yii::app()->user->hasFlash('failure')):?>
<div class="alert alert-error">
      <?php echo Yii::app()->user->getFlash('failure');?>
</div>
<?php endif;?>
<?php echo $this->renderPartial('_site_form', array('model'=>$model)); ?>
</div>

<?php //print_r(Layer::getSterilizationAndInfectionControlOptions());?>