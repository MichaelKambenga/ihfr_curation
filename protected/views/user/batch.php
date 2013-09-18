
<h4>Add Privileges to the User:- <?php echo $email; ?></h4>

<?php if(Yii::app()->user->hasFlash('success')):?>
<div >
      <p class="success"><?php echo Yii::app()->user->getFlash('success');?></p>
</div>
      <?php endif;?>

<?php if(Yii::app()->user->hasFlash('failure')):?>
<div >
      <p class="failure"><?php echo Yii::app()->user->getFlash('failure');?></p>
</div>
<?php endif;?>

<?php echo CHtml::beginForm('', 'POST', array('id' => 'group-form')); ?>
<?php

$this->widget('zii.widgets.grid.CGridView', array(
'id' => 'group-grid',
 'dataProvider' => $dataProvider,
 'selectableRows' => 2, // multiple rows can be selected
'ajaxUpdate' => false,
 'columns' => array(
array(
'class' => 'CCheckBoxColumn',
 'id' => 'name[]',
//'checked' => 'AuthAssignment::isAssigned('.'$data->name'.', '.$id.')',
'checked' => 'AuthAssignment::isAssigned('.'$data->name'.', '.$email.')',
//        array(
//            'name'=>'Name',
//            'value'=>'$data->name',
      ),
'name',
 'description',
 ),
));
?>
<?php echo CHtml::submitButton('Assign'); ?>
<?php echo CHtml::endForm(); ?>

