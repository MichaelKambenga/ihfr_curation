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
<script type="text/javascript">
    var trashButton ='link';
    
    function deleteUser(){
      $.get(trashButton,function(data,status){
         $("#delete-model-message .modal-body p").html(data);
         $("#delete-model-message").modal();
         $.fn.yiiGridView.update('user-grid');
      });
   }
</script>

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
             'email',
            array('name' => 'node_id',
                'value' => '$data->node_id',
                'htmlOptions' => array('id' => 'text', 'class' => 'name_text', 'size' => 30),
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
            array('name' => 'phone_number',
                'value' => '$data->phone_number',
                'htmlOptions' => array('id' => 'text', 'class' => 'name_text', 'size' => 30),
            ),
            array(
                'header'=>'Status',
                'value'=>'$data->active==1?"Active":"Inactive"'
            ),
            array(
                'class' => 'bootstrap.widgets.TbButtonColumn',
                'template' => '{view} {update} {delete}',
                'header' => 'Options',
                'buttons' => array(
                    'view' => array(
                    ),
                    'update' => array(
//                        'url' => '#',
//                        'click' => 'js: function(){$("#user-edit-modal").modal();}',
                    ),
                    'delete' => array(
                        'url' => '$this->grid->controller->createUrl("user/delete",array("id"=>$data->id))',
                        'click' => 'js: function(){
                            $("#user-delete-modal").modal();
                            trashButton = this;
                            return false;
                            }',
                    ),
                ),
            ),
        ),
    ));
    ?>

    <?php
    $this->widget('bootstrap.widgets.TbModal', array(
        'id' => 'user-delete-modal',
        'header' => 'Confirm delete',
        'content' => '<p>Are you sure you want to delete this user?</p>',
        'footer' => array(
           TbHtml::button('Cancel', array('data-dismiss' => 'modal')),
           TbHtml::button('OK', array('data-dismiss' => 'modal','onclick'=>'js:deleteUser();' , 'color' => TbHtml::BUTTON_COLOR_PRIMARY)),
        ),
    ));
    ?>
    
    <?php
    $this->widget('bootstrap.widgets.TbModal', array(
        'id' => 'delete-model-message',
        'header' => 'Alert',
        'content' => '<p></p>',
        'footer' => array(
            TbHtml::button('Close', array('data-dismiss' => 'modal')),
        ),
    ));
   ?>

</div>