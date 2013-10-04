<?php
/* @var $this FieldMappingController */
/* @var $data FieldMapping */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cc_field_id')); ?>:</b>
	<?php echo CHtml::encode($data->cc_field_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pc_field_id')); ?>:</b>
	<?php echo CHtml::encode($data->pc_field_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('semantics')); ?>:</b>
	<?php echo CHtml::encode($data->semantics); ?>
	<br />


</div>