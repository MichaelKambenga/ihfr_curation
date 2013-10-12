<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<div class="row">
		<?php echo $form->labelEx($model,'generalClinicalServices'); ?>
		<?php echo TbHtml::activeCheckBoxList($model,'generalClinicalServices', Layer::getGeneralClinicalServicesOptions()); ?>
		<?php echo $form->error($model,'generalClinicalServices'); ?>
</div>

<div class="row">
		<?php echo $form->labelEx($model,'malariaDiagnosisAndTreatment'); ?>
		<?php echo TbHtml::activeCheckBoxList($model,'malariaDiagnosisAndTreatment', Layer::getMalariaServicesOptions()); ?>
		<?php echo $form->error($model,'malariaDiagnosisAndTreatment'); ?>
 </div>

<div class="row">
		<?php echo $form->labelEx($model,'TBDiagnosisCareAndTreatment'); ?>
		<?php echo TbHtml::activeCheckBoxList($model,'TBDiagnosisCareAndTreatment',  Layer::getTBServicesOptions()); ?>
		<?php echo $form->error($model,'TBDiagnosisCareAndTreatment'); ?>
 </div>

<div class="row">
		<?php echo $form->labelEx($model,'cardiovasculasCareAndTreatment'); ?>
		<?php echo TbHtml::activeCheckBoxList($model,'cardiovasculasCareAndTreatment',  Layer::getCardiovascularServicesOptions()); ?>
		<?php echo $form->error($model,'cardiovasculasCareAndTreatment'); ?>
 </div>

<div class="row">
		<?php echo $form->labelEx($model,'HIVAIDSPrevention'); ?>
		<?php echo TbHtml::activeCheckBoxList($model,'HIVAIDSPrevention',  Layer::getHIVAIDSPreventionServicesOptions()); ?>
		<?php echo $form->error($model,'HIVAIDSPrevention'); ?>
 </div>

<div class="row">
		<?php echo $form->labelEx($model,'HIVAIDSCareAndTreatment'); ?>
		<?php echo TbHtml::activeCheckBoxList($model,'HIVAIDSCareAndTreatment',  Layer::getHIVAIDSCareAndTreatmentServicesOptions()); ?>
		<?php echo $form->error($model,'HIVAIDSCareAndTreatment'); ?>
 </div>

<div class="row">
		<?php echo $form->labelEx($model,'therapeutics'); ?>
		<?php echo TbHtml::activeCheckBoxList($model,'therapeutics',  Layer::getTherapeuticsServicesOptions()); ?>
		<?php echo $form->error($model,'therapeutics'); ?>
 </div>
<div class="row">
		<?php echo $form->labelEx($model,'prostheticsAndMedicalDevices'); ?>
		<?php echo TbHtml::activeCheckBoxList($model,'prostheticsAndMedicalDevices',Layer::getProstheticsAndMedicalDevicesServicesOptions()); ?>
		<?php echo $form->error($model,'prostheticsAndMedicalDevices'); ?>
 </div>

<div class="row">
		<?php echo $form->labelEx($model,'healthPromotionAndDiseasePrevention'); ?>
		<?php echo TbHtml::activeCheckBoxList($model,'healthPromotionAndDiseasePrevention',Layer::getHealthPromotionAndDiseasePrventionServicesOptions()); ?>
		<?php echo $form->error($model,'healthPromotionAndDiseasePrevention'); ?>
 </div>

<div class="row">
		<?php echo $form->labelEx($model,'diagnosticServices'); ?>
		<?php echo TbHtml::activeCheckBoxList($model,'diagnosticServices',  Layer::getDiagnosticServicesOptions()); ?>
		<?php echo $form->error($model,'diagnosticServices'); ?>
 </div>
<div class="row">
		<?php echo $form->labelEx($model,'reproductiveAndChildHealthCareServices'); ?>
		<?php echo TbHtml::activeCheckBoxList($model,'reproductiveAndChildHealthCareServices',Layer::getReproductiveAndChildHealthCareServicesOptions()); ?>
		<?php echo $form->error($model,'reproductiveAndChildHealthCareServices'); ?>
 </div>

<div class="row">
		<?php echo $form->labelEx($model,'growthMonitoringOrNutritionalSurveillance'); ?>
		<?php echo TbHtml::activeCheckBoxList($model,'growthMonitoringOrNutritionalSurveillance',  Layer::getGrowthMonitoringAndNutritionSurveillanceServicesOptions()); ?>
		<?php echo $form->error($model,'growthMonitoringOrNutritionalSurveillance'); ?>
 </div>

<div class="row">
		<?php echo $form->labelEx($model,'oralHealthService'); ?>
		<?php echo TbHtml::activeCheckBoxList($model,'oralHealthService',  Layer::getDentalServicesOptions()); ?>
		<?php echo $form->error($model,'oralHealthService'); ?>
 </div>
<div class="row">
		<?php echo $form->labelEx($model,'ENTServices'); ?>
		<?php echo TbHtml::activeCheckBoxList($model,'ENTServices',  Layer::getENTServicesOptions()); ?>
		<?php echo $form->error($model,'ENTServices'); ?>
 </div>

<div class="row">
		<?php echo $form->labelEx($model,'supportServices'); ?>
		<?php echo TbHtml::activeCheckBoxList($model,'supportServices',  Layer::getSupportServicesOptions()); ?>
		<?php echo $form->error($model,'supportServices'); ?>
 </div>

<div class="row">
		<?php echo $form->labelEx($model,'emergencyPreparedness'); ?>
		<?php echo TbHtml::activeCheckBoxList($model,'emergencyPreparedness',  Layer::getEmergencyPreparednessServicesOptions()); ?>
		<?php echo $form->error($model,'emergencyPreparedness'); ?>
 </div>
<div class="row">
		<?php echo $form->labelEx($model,'otherServices'); ?>
		<?php echo $form->textField($model,'otherServices'); ?>
		<?php echo $form->error($model,'otherServices'); ?>
 </div>

