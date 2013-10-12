<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<div class="row">
		<?php echo $form->labelEx($model,'locationDescription'); ?>
		<?php echo $form->textField($model,'locationDescription'); ?>
		<?php echo $form->error($model,'locationDescription'); ?>
 </div>

<div class="row">
		<?php echo $form->labelEx($model,'wayPointNumber'); ?>
		<?php echo $form->textField($model,'wayPointNumber'); ?>
		<?php echo $form->error($model,'wayPointNumber'); ?>
 </div>

<div class="row">
		<?php echo $form->labelEx($model,'altitute'); ?>
		<?php echo $form->textField($model,'altitute'); ?>
		<?php echo $form->error($model,'altitute'); ?>
 </div>

<div class="row">
		<?php echo $form->labelEx($model,'serviceAreas'); ?>
		<?php echo $form->textField($model,'serviceAreas'); ?>
		<?php echo $form->error($model,'serviceAreas'); ?>
 </div>

<div class="row">
		<?php echo $form->labelEx($model,'serviceAreaPopulation'); ?>
		<?php echo $form->textField($model,'serviceAreaPopulation'); ?>
		<?php echo $form->error($model,'serviceAreaPopulation'); ?>
 </div>

<div class="row">
		<?php echo $form->labelEx($model,'catchmentArea'); ?>
		<?php echo $form->textField($model,'catchmentArea'); ?>
		<?php echo $form->error($model,'catchmentArea'); ?>
 </div>

<div class="row">
		<?php echo $form->labelEx($model,'catchmentPopulation'); ?>
		<?php echo $form->textField($model,'catchmentPopulation'); ?>
		<?php echo $form->error($model,'catchmentPopulation'); ?>
 </div>

<div class="row">
		<?php echo $form->labelEx($model,'dateOpened'); ?>
		<?php echo $form->textField($model,'dateOpened'); ?>
		<?php echo $form->error($model,'dateOpened'); ?>
 </div>

