<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<div class="row">
		<?php echo $form->labelEx($model,'ownershipDetailOrName'); ?>
		<?php echo $form->textField($model,'ownershipDetailOrName'); ?>
		<?php echo $form->error($model,'ownershipDetailOrName'); ?>
 </div>

<div class="row">
		<?php echo $form->labelEx($model,'registrationStatus'); ?>
		<?php echo $form->dropDownList($model,'registrationStatus', Layer::getRegistrationStatusOptions(),array('empty'=>'--Please select--')); ?>
		<?php echo $form->error($model,'registrationStatus'); ?>
</div>

<div class="row">
		<?php echo $form->labelEx($model,'licensingStatus'); ?>
		<?php echo $form->dropDownList($model,'licensingStatus', Layer::getLicensingStatusOptions(),array('empty'=>'--Please select--')); ?>
		<?php echo $form->error($model,'licensingStatus'); ?>
</div>

<div class="row">
		<?php echo $form->labelEx($model,'otherClinic'); ?>
		<?php echo $form->textField($model,'otherClinic'); ?>
		<?php echo $form->error($model,'otherClinic'); ?>
 </div>