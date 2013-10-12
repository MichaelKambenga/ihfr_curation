<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<?php echo $form->errorSummary($model); ?>
    
        <div class="row">
		<?php echo $form->labelEx($model,'properties[Admin_div]'); ?>
		<?php echo $form->hiddenField($model,'properties[Admin_div]',array('size'=>60,'maxlength'=>64)); ?>
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
                <?php echo $form->error($model,'properties[Admin_div]'); ?>
	</div>
    
        <div class="row">
		<?php echo $form->labelEx($model,'properties[Ownership]'); ?>
		<?php echo $form->hiddenField($model,'properties[Ownership]',array('size'=>60,'maxlength'=>64)); ?>
		
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
            <?php echo $form->error($model,'properties[Ownership]'); ?>
	</div>
    
    
        <div class="row">
		<?php echo $form->labelEx($model,'properties[OperatingStatus]'); ?>
		<?php echo $form->dropDownList($model,'properties[OperatingStatus]', Layer::getOperatingStatusOptions(),array('empty'=>'--Please select--')); ?>
		<?php echo $form->error($model,'properties[OperatingStatus]'); ?>
	</div>

         <div class="row">
		<?php echo $form->labelEx($model,'properties[Fac_Type]'); ?>
		<?php echo $form->hiddenField($model,'properties[Fac_Type]',array('size'=>60,'maxlength'=>64)); ?>
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
                <?php echo $form->error($model,'properties[Fac_Type]'); ?>
	</div>

	
