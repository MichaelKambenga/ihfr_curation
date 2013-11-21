<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<div class="row">
		<?php echo $form->labelEx($model,'note'); ?>
		<?php echo $form->textArea($model,'note',array('style'=>'width:70%;height:100px')); ?>
		<?php echo $form->error($model,'note'); ?>
</div>