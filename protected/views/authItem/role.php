<?php
$this->breadcrumbs = array(
    'Groups' => array('index'),
    'Manage',
);

//$this->menu=array(
//	//array('label'=>'List AuthItem', 'url'=>array('index')),
//	//array('label'=>'Create AuthItem', 'url'=>array('create')),
//);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('auth-item-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php echo TbHtml::pageHeader('', 'Roles') ?>

<div class="well">
    <?php $this->renderPartial('//authItem/navigations'); ?>
    <?php
    $this->widget('bootstrap.widgets.TbGridView', array(
        'type' => TbHtml::GRID_TYPE_BORDERED,
        'id' => 'auth-item-grid',
        'dataProvider' => $dataProvider,
       // 'filter'=>$model,
        'columns' => array(
//            array('name' => 'Number',
//                'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
//                ),
            'name',
            //'type',
            'description',
            //'bizrule',
            //'data',
            array(
                'class' => 'bootstrap.widgets.TbButtonColumn',
                'header' => 'Options',
                'template' => '{view}{update}{delete}',
                'buttons' => array(
                    'delete' => array('url' => 'Yii::app()->createUrl("authItem/delete/",array("id" =>  $data->name))'),
                    // 'update' => array('url' => 'Yii::app()->createUrl("authItem/update/",array("id" =>  $data->name))'),
                    'update' => array(
                        //'visible' => '(Yii::app()->user->getState("SSPerson"))?TRUE:FALSE',
                        'url' => '$this->grid->controller->createUrl("authItem/update", array("id"=>$data->name,"asDialog"=>1,"gridId"=>$this->grid->id))',
                        'click' => 'function(){$("#edit-frame").attr("src",$(this).attr("href")); $("#edit-dialog").dialog("open");  return false;}',
                    ),
                    'view' => array('url' => 'Yii::app()->createUrl("authItem/view/",array("id" =>  $data->name))'),
                ),
            ),
        ),
    ));
    ?>

    <?php
    $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
        'id' => 'edit-dialog',
        'options' => array(
            'title' => 'Edit Group Details',
            'autoOpen' => false,
            'modal' => false,
            'width' => '600',
            'height' => '480',
        ),
    ));
    ?>
    
    <iframe id="edit-frame" width="90%" height="90%"></iframe>

    <?php
    $this->endWidget();
    ?>

</div>