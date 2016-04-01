<?php
$this->breadcrumbs=array(
	'System Audits'=>array('admin'),
	'Manage',
);

?>

<?php echo TbHtml::pageHeader('', 'System Audits...') ?>
<div class="well">
<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'system-audit-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		   // 'auditId',
                     array('name' => 'number',
                           'header' => '#',
                           'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
                         ),
                    array('name' => 'userId',
                          'value' => '$data->actor->email',
                        ),
		    'action',
		    'date',
//		   array(
//			'class'=>'CButtonColumn',
//		),
	),
)); ?>
</div>
