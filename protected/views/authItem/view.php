<?php
$this->breadcrumbs = array(
    'Groups' => array('index'),
    $model->name,
);
?>

<?php echo TbHtml::pageHeader('', 'View Group/Role'); ?>

<div class="well">
    <?php
    $this->widget('bootstrap.widgets.TbDetailView', array(
        'type' => TbHtml::DETAIL_TYPE_BORDERED,
        'data' => $model,
        'attributes' => array(
            'name',
            //'type',
            'description',
        //'bizrule',
        //'data',
        ),
    ));

    ?>
    <?php echo TbHtml::link('Add access items to this group', $this->createUrl('/authItem/assignItems', array('name' => $model->name)), array('class' => 'btn btn-primary')); ?>
</div>
