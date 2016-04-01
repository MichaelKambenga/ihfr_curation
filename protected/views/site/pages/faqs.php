<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - FAQs';
$this->breadcrumbs=array(
	'FAQs',
);
?>
<?php echo TbHtml::pageHeader('','Frequently Asked Questions....'); ?>

<div class="well">
<?php echo TbHtml::link('Add New', $this->createUrl('faqs/create/'), array('class'=>'btn btn-info',)); ?>
</div>