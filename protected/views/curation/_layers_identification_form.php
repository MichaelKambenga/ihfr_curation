<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

 <div class="row">
		<?php echo $form->labelEx($model,'commonFacilityName'); ?>
		<?php echo $form->textField($model,'commonFacilityName'); ?>
		<?php echo $form->error($model,'commonFacilityName'); ?>
 </div>

<div class="row">
		<?php echo $form->labelEx($model,'registrationId'); ?>
		<?php echo $form->textField($model,'registrationId'); ?>
		<?php echo $form->error($model,'registrationId'); ?>
 </div>

<div class="row">
		<?php echo $form->labelEx($model,'ctcId'); ?>
		<?php echo $form->textField($model,'ctcId'); ?>
		<?php echo $form->error($model,'ctcId'); ?>
 </div>

<div class="row">
		<?php echo $form->labelEx($model,'mtuhaCode'); ?>
		<?php echo $form->textField($model,'mtuhaCode'); ?>
		<?php echo $form->error($model,'mtuhaCode'); ?>
 </div>

