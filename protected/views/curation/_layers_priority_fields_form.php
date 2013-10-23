<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<?php echo $form->errorSummary($model); ?>
    
        <div class="row">
		<?php echo $form->labelEx($model,'administrativeDivision'); ?>
		<?php echo $form->hiddenField($model,'administrativeDivision',array('size'=>60,'maxlength'=>64)); ?>
		<span>
                <?php $this->widget('CTreeView',array(
                        'id'=>'admin-div-treeview',
                        'data'=>Layer::getAdministrativeDivisionOptions(),
                        'control'=>'#treecontrol',
                        'animated'=>'fast',
                        'collapsed'=>true,
                        'htmlOptions'=>array(
                           'class'=>'treeview-gray',

                        )
                  ) );

                  ?>
                </span>
                <?php echo $form->error($model,'administrativeDivision'); ?>
	</div>
    
        <div class="row">
		<?php echo $form->labelEx($model,'ownership'); ?>
		<?php echo $form->hiddenField($model,'ownership',array('size'=>60,'maxlength'=>64)); ?>
		
            <span>
                <?php $this->widget('CTreeView',array(
                        'id'=>'ownership-treeview',
                        'data'=>Layer::getOwnershipOptions(),
                        'control'=>'#treecontrol',
                        'animated'=>'fast',
                        'collapsed'=>true,
                        'htmlOptions'=>array(
                           'class'=>'treeview-gray',

                        )
                  ) );

                  ?>
            </span>
            <?php echo $form->error($model,'ownership'); ?>
	</div>
    
    
        <div class="row">
		<?php echo $form->labelEx($model,'operatingStatus'); ?>
		<?php echo $form->dropDownList($model,'operatingStatus', Layer::getOperatingStatusOptions(),array('empty'=>'--Please select--')); ?>
		<?php echo $form->error($model,'operatingStatus'); ?>
	</div>

         <div class="row">
		<?php echo $form->labelEx($model,'facilityType'); ?>
		<?php echo $form->hiddenField($model,'facilityType',array('size'=>60,'maxlength'=>64)); ?>
		 <span>
                <?php $this->widget('CTreeView',array(
                        'id'=>'facility-type-treeview',
                        'data'=>Layer::getFacilityTypeOptions(),
                        'control'=>'#treecontrol',
                        'animated'=>'fast',
                        'collapsed'=>true,
                        'htmlOptions'=>array(
                           'class'=>'treeview-gray',

                        )
                  ) );

                  ?>
            </span>
                <?php echo $form->error($model,'facilityType'); ?>
	</div>

	
