<?php
/* @var $this FaqsController */
/* @var $model Faqs */

?>

<?php echo TbHtml::pageHeader('','Frequently Asked Questions....'); ?>

<div class="well">
<?php 
  if(Yii::app()->user->checkAccess('Administrator')){
    echo TbHtml::link('Add New', $this->createUrl('faqs/create/'), array('class'=>'btn btn-info',)); 
  }
?>
       
<?php $this->widget('bootstrap.widgets.TbGridView',array(
        'type' => TbHtml::GRID_TYPE_STRIPED,
	'id'=>'faqs-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
                 array('name' => 'number',
                    'header' => '#',
                    'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
                ),
		'question',
		'answer',
               array(
                   'name'=>'attachment',
                    'type'=>'raw',
                    'value'=>'Faqs::model()->downloadAttachment($data->attachment)'
                ),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>

</div>