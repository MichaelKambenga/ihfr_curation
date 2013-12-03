<?php echo TbHtml::pageHeader('', 'Manage Organizations') ?>
<div class="well">
    <?php $this->renderPartial('//organization/navigations'); ?>
    
<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'organization-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
                array('name' => 'number',
                    'header' => '#',
                    'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
                ),
		//'id',
		'organization_name',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>

</div>