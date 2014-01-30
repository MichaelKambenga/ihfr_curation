

<?php echo TbHtml::pageHeader('', 'My requests') ?>

<div class="well">
<?php   
        $this->widget('bootstrap.widgets.TbGridView', array(
        'type' => TbHtml::GRID_TYPE_BORDERED,
	'id'=>'change-request-grid',
	'dataProvider'=>$model->myRecentlyPendingRequests(),
	'filter'=>$model,
	'columns'=>array(
		'id',
//		'primary_site_code',
                array('header' => 'Luhn ID',
                    'value' => '$data->primary_site_code',
                    'htmlOptions' => array('id' => 'text', 'class' => 'name_text', 'width' => 100),
                ),
		'cc_site_id',
		'version_id',
		'requested_by',
		'request_type',
		/*
		'status',
		'requested_date',
		'reviewed_date',
		'reviewed_by',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
 </div>
