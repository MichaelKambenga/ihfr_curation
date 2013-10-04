<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs = array(
    'Users' => array('index'),
    $model->id,
);
?>

<?php echo TbHtml::pageHeader('','View User'); ?>

<div class="well">
<?php
$this->widget('bootstrap.widgets.TbDetailView', array(
    'type'=>  TbHtml::DETAIL_TYPE_BORDERED,
    'data' => $model,
    'attributes' => array(
      //  'id',
        'email',
        'node_id',
        array(
            'label' => 'position_id',
            'value' => $model->position->position_name,
        ),
        array(
            'label' => 'organization_id',
            'value' => $model->organization->organization_name,
        ),
        'phone_number',
    ),
));

?>
    
<?php echo TbHtml::link('Add privileges to this user',  $this->createUrl('/user/assignRoles', array('id' => $model->id, 'email' => $model->email)), array('class'=>'btn btn-primary')); ?>

</div>