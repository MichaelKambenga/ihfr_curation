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
                'header' => 'Number',
                'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
            ),
            //'id',
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
                    // 'visible' => '(Yii::app()->user->getState("SSPerson") || Yii::app()->user->getState("CManager") || Yii::app()->user->getState("CAccountant"))?TRUE:FALSE',
                    ),
                    'update' => array(
                        //'visible' => '(Yii::app()->user->getState("SSPerson"))?TRUE:FALSE',
                        'url' => '$this->grid->controller->createUrl("user/update", array("id"=>$data->primaryKey,"asDialog"=>1,"gridId"=>$this->grid->id))',
                        'click' => 'function(){$("#edit-frame").attr("src",$(this).attr("href")); $("#edit-dialog").dialog("open");  return false;}',
                    ),
                    'delete' => array(
                    // 'visible' => '(Yii::app()->user->getState("SSPerson"))?TRUE:FALSE',
                    ),
                ),
            ),
        ),
    ));
    ?>

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
    <iframe id="edit-frame" width="91%" height="92%"></iframe>

    <?php
    $this->endWidget();
    ?>
</div>