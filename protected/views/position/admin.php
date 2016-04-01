<?php echo TbHtml::pageHeader('', 'Manage Positions') ?>

<div class="well">
    <?php $this->renderPartial('//position/navigations'); ?>
    
<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'position-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
                array('name' => 'number',
                        'header' => '#',
                        'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
                ),
		//'id',
		'position_name',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>

</div>