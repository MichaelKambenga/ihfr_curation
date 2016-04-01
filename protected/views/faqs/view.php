<?php
/* @var $this FaqsController */
/* @var $model Faqs */
?>

<?php
     echo TbHtml::pageHeader('',' Frequently Asked Questions....'.$model->id);
?>
<div class="well">
    
<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'id',
		'question',
		'answer',
		'attachment',
	),
)); ?>

</div>