

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'site-form',
	'enableAjaxValidation'=>false,
)); ?>
    
    <?php 
 ob_start();
    $this->renderPartial('_layers_priority_fields_form',array('model'=>$model,'form'=>$form));
    $priorityFieldsView = ob_get_contents();
 ob_end_clean();
 
 ob_start();
    $this->renderPartial('_layers_identification_form',array('model'=>$model,'form'=>$form));
    $identificationView = ob_get_contents();
 ob_end_clean();
 
 ob_start();
 $this->renderPartial('_layers_contact_info_form',array('model'=>$model,'form'=>$form));
    $contactInfoView = ob_get_contents();
 ob_end_clean();
 
 ob_start();
  $this->renderPartial('_layers_physical_location_form',array('model'=>$model,'form'=>$form));
   $physicalLocationView = ob_get_contents();
 ob_end_clean();
 
 ob_start();
  $this->renderPartial('_layers_classification_form',array('model'=>$model,'form'=>$form));
    $classificationView = ob_get_contents();
 ob_end_clean();
 
 ob_start();
  $this->renderPartial('_layers_infrastructure_form',array('model'=>$model,'form'=>$form));
    $infrastructureView = ob_get_contents();
 ob_end_clean();
 
 ob_start();
  $this->renderPartial('_layers_services_offered_form',array('model'=>$model,'form'=>$form));
    $serviceOfferedView = ob_get_contents();
 ob_end_clean();
 
 ob_start();
  $this->renderPartial('_layers_temp_fields_form',array('model'=>$model,'form'=>$form));
    $tempFieldsView = ob_get_contents();
 ob_end_clean();
 
 ob_start();
  $this->renderPartial('_layers_remarks_form',array('model'=>$model,'form'=>$form));
    $remarksView = ob_get_contents();
 ob_end_clean();
 
    ?>
   <?php
     
   $this->widget('zii.widgets.jui.CJuiAccordion', array(
       'id'=>'accordion',
       'panels' => array(
           'Priority Fields' => $priorityFieldsView,
           'Identification' => $identificationView,
           'Contact Information' => $contactInfoView,
           'Physical Location' => $physicalLocationView,
           'Classification' => $classificationView,
           'Infrastructure' => $infrastructureView,
           'Services Offered' => $serviceOfferedView,
           'Temp Fields' => $tempFieldsView,
           'Remarks' => $remarksView,
         ),
       
       'options' => array(
           'collapsible' => true,
           'active' => 0,
           'clearStyle'=>true,
           'fillSpace'=>true,
       ),
       'htmlOptions' => array(
           'style' => 'width:70%;'
       ),
   ));
   ?>
    
    <div class="row buttons">
        <?php echo CHtml::submitButton('Send Site Create Request',array('class'=>'btn btn-info')); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->
