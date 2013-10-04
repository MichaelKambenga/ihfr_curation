<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs = array(
    'Users' => array('index'),
    'Manage',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#user-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php echo TbHtml::pageHeader('', 'User Management') ?>

<div class="well">
    <?php $this->renderPartial('//user/navigations'); ?>
    <?php
    $this->widget('bootstrap.widgets.TbGridView', array(
        'type' => TbHtml::GRID_TYPE_BORDERED,
        'id' => 'user-grid',
        'dataProvider' => $model->search(),
        'filter' => $model,
        'columns' => array(
            array('name' => 'number',
                'header' => 'ID',
                'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
            ),
            
            // 'position_id',
            array('name' => 'position_id',
                'value' => '$data->position->position_name',
                'htmlOptions' => array('id' => 'text', 'class' => 'name_text', 'size' => 30),
            ),
            array('name' => 'organization_id',
                'value' => '$data->organization->organization_name',
                'htmlOptions' => array('id' => 'text', 'class' => 'name_text', 'size' => 30),
            ),
            //'organization_id',
            'email',
            array(
                'class' => 'bootstrap.widgets.TbButtonColumn',
                'template' => '{view} {update} {delete}',
                'header' => 'Options',
                'buttons' => array(
                    'view' => array(
                    ),
                    'update' => array(
                        'url' =>'#' ,
                        'click'=>'js: function(){$("#myModal").modal();}',
                        
                        
                     ),
                    'delete' => array(
                   ),
                ),
            ),
        ),
    ));
    ?>

 <?php $this->widget('bootstrap.widgets.TbModal', array(
'id' => 'myModal',
'header' => 'Modal Heading',
'content' => '<p>One fine body...</p>',
'footer' => array(
TbHtml::button('Save Changes', array('data-dismiss' => 'modal', 'color' => TbHtml::BUTTON_COLOR_PRIMARY)),
TbHtml::button('Close', array('data-dismiss' => 'modal')),
),
)); ?>
 
    
    <?php
    $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
        'id' => 'edit-dialog',
        'options' => array(
            'title' => 'Edit User Details',
            'autoOpen' => false,
            'modal' => false,
            'width' => '670',
            'height' => '450',
        ),
    ));
    ?>
    <!--<iframe id="edit-frame" width="91%" height="92%"></iframe>-->

    <?php
    $this->endWidget();
    ?>
</div>