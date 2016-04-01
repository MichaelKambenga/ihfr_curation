<?php
/* @var $this ChangeRequestController */
/* @var $data ChangeRequest */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('primary_site_code')); ?>:</b>
	<?php echo CHtml::encode($data->primary_site_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cc_site_id')); ?>:</b>
	<?php echo CHtml::encode($data->cc_site_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('version_id')); ?>:</b>
	<?php echo CHtml::encode($data->version_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('requested_by')); ?>:</b>
	<?php echo CHtml::encode($data->requested_by); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('request_type')); ?>:</b>
	<?php echo CHtml::encode($data->request_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('requested_date')); ?>:</b>
	<?php echo CHtml::encode($data->requested_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('reviewed_date')); ?>:</b>
	<?php echo CHtml::encode($data->reviewed_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('reviewed_by')); ?>:</b>
	<?php echo CHtml::encode($data->reviewed_by); ?>
	<br />

	*/ ?>

</div>