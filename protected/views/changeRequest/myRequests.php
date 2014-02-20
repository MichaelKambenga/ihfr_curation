

<?php echo TbHtml::pageHeader('', 'My Recent Requests') ?>

<div class="well">
<?php   
        $this->widget('bootstrap.widgets.TbGridView', array(
        'type' => TbHtml::GRID_TYPE_BORDERED,
	'id'=>'change-request-grid',
	'dataProvider'=>$model->myRequests(),
	//'filter'=>$model,
	'columns'=>array(
		//'id',
//		'primary_site_code',
                array('header' => 'Primary Site Code',
                    'value' => '$data->primary_site_code',
                ),
		//'version_id',
		//'requested_by',
		//'request_type',
                array('header'=> 'Request Type',
                     'type'=>'html',
                     'value'=>'$data->getRequestType($data->request_type,$style=true)',
                     
                    
                ),
                array('header' => 'Status',
                    'type'=>'html',
                    'value' => '$data->getRequestStatus($data->status,$style=true)',
                ),
                array(
                    'header'=>'Reviewed By',
                    'type'=>'html',
                    'value'=>'User::getUserSignature($data->reviewed_by)'
                ),
            
                array(
                    'header'=>'Requested Date',
                    'value'=>'$data->requested_date'
                ),
            
               array(
                    'header'=>'Reason',
                    'type'=>'html',
                    'value'=>'ChangeRequest::getChangeRequestNotes($data)'
                ),
                
                /*
                'cc_site_id',
                'pc_site_id',
		
		'reviewed_date',
		
		*/
//		array(
//			'class'=>'CButtonColumn',
//		),
	),
)); ?>
 </div>
