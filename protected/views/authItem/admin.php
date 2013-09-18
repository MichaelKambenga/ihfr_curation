<?php
//$this->breadcrumbs=array(
//	'Groups'=>array('index'),
//	'Manage',
//);

$this->renderPartial('//authItem/navigations');

$this->menu=array(
	//array('label'=>'List AuthItem', 'url'=>array('index')),
	//array('label'=>'Create AuthItem', 'url'=>array('create')),
);

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

<!--<h1>Manage Authentication Items</h1>-->

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'auth-item-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'columns'=>array(
            array('name' => 'Number',
                'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
                ),
		'name',
		'type',
		'description',
		'bizrule',
		'data',
		array(
			'class'=>'CButtonColumn',
                        'header' => 'Options',
		),
	),
)); ?>
