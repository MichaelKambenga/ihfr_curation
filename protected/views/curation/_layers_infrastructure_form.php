<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<div class="row">
		<?php echo $form->labelEx($model,'receptionRoom'); ?>
		<?php echo $form->textField($model,'receptionRoom'); ?>
		<?php echo $form->error($model,'receptionRoom'); ?>
 </div>

<div class="row">
		<?php echo $form->labelEx($model,'consultationRoom'); ?>
		<?php echo $form->textField($model,'consultationRoom'); ?>
		<?php echo $form->error($model,'consultationRoom'); ?>
 </div>

<div class="row">
		<?php echo $form->labelEx($model,'dressingRoom'); ?>
		<?php echo $form->textField($model,'dressingRoom'); ?>
		<?php echo $form->error($model,'dressingRoom'); ?>
 </div>

<div class="row">
		<?php echo $form->labelEx($model,'injectionRoom'); ?>
		<?php echo $form->textField($model,'injectionRoom'); ?>
		<?php echo $form->error($model,'injectionRoom'); ?>
 </div>

<div class="row">
		<?php echo $form->labelEx($model,'wardRoom'); ?>
		<?php echo $form->textField($model,'wardRoom'); ?>
		<?php echo $form->error($model,'wardRoom'); ?>
 </div>

<div class="row">
		<?php echo $form->labelEx($model,'observationRoom'); ?>
		<?php echo $form->textField($model,'observationRoom'); ?>
		<?php echo $form->error($model,'observationRoom'); ?>
 </div>

<div class="row">
		<?php echo $form->labelEx($model,'remarks'); ?>
		<?php echo $form->textField($model,'remarks'); ?>
		<?php echo $form->error($model,'remarks'); ?>
 </div>

<div class="row">
		<?php echo $form->labelEx($model,'patientBeds'); ?>
		<?php echo $form->textField($model,'patientBeds'); ?>
		<?php echo $form->error($model,'patientBeds'); ?>
 </div>

<div class="row">
		<?php echo $form->labelEx($model,'deliveryBeds'); ?>
		<?php echo $form->textField($model,'deliveryBeds'); ?>
		<?php echo $form->error($model,'deliveryBeds'); ?>
 </div>

<div class="row">
		<?php echo $form->labelEx($model,'babyCots'); ?>
		<?php echo $form->textField($model,'babyCots'); ?>
		<?php echo $form->error($model,'babyCots'); ?>
 </div>

<div class="row">
		<?php echo $form->labelEx($model,'ambulances'); ?>
		<?php echo $form->textField($model,'ambulances'); ?>
		<?php echo $form->error($model,'ambulances'); ?>
 </div>

<div class="row">
		<?php echo $form->labelEx($model,'cars'); ?>
		<?php echo $form->textField($model,'cars'); ?>
		<?php echo $form->error($model,'cars'); ?>
 </div>

<div class="row">
		<?php echo $form->labelEx($model,'motorcycles'); ?>
		<?php echo $form->textField($model,'motorcycles'); ?>
		<?php echo $form->error($model,'motorcycles'); ?>
 </div>

<div class="row">
		<?php echo $form->labelEx($model,'otherTransport'); ?>
		<?php echo $form->textField($model,'otherTransport'); ?>
		<?php echo $form->error($model,'otherTransport'); ?>
 </div>

<div class="row">
		<?php echo $form->labelEx($model,'noOfOtherTransport'); ?>
		<?php echo $form->textField($model,'noOfOtherTransport'); ?>
		<?php echo $form->error($model,'noOfOtherTransport'); ?>
 </div>

<div class="row">
		<?php echo $form->labelEx($model,'sterilizationAndInfectionControl'); ?>
		<?php echo TbHtml::activeCheckBoxList($model,'sterilizationAndInfectionControl', Layer::getSterilizationAndInfectionControlOptions()); ?>
		<?php echo $form->error($model,'sterilizationAndInfectionControl'); ?>
</div>

<div class="row">
		<?php echo $form->labelEx($model,'meansOfTransportToReferralPoint'); ?>
		<?php echo $form->textField($model,'meansOfTransportToReferralPoint'); ?>
		<?php echo $form->error($model,'meansOfTransportToReferralPoint'); ?>
 </div>

<div class="row">
		<?php echo $form->labelEx($model,'distanceToReferralPoint'); ?>
		<?php echo $form->textField($model,'distanceToReferralPoint'); ?>
		<?php echo $form->error($model,'distanceToReferralPoint'); ?>
 </div>

<div class="row">
		<?php echo $form->labelEx($model,'challengesToReachReferralPoint'); ?>
		<?php echo $form->textField($model,'challengesToReachReferralPoint'); ?>
		<?php echo $form->error($model,'challengesToReachReferralPoint'); ?>
 </div>

<div class="row">
		<?php echo $form->labelEx($model,'sourceOfEnergy'); ?>
		<?php echo TbHtml::activeCheckBoxList($model,'sourceOfEnergy', Layer::getSourceOfEnergyOptions()); ?>
		<?php echo $form->error($model,'sourceOfEnergy'); ?>
</div>

<div class="row">
		<?php echo $form->labelEx($model,'otherEnergySource'); ?>
		<?php echo $form->textField($model,'otherEnergySource'); ?>
		<?php echo $form->error($model,'otherEnergySource'); ?>
 </div>

<div class="row">
		<?php echo $form->labelEx($model,'mobileNetworks'); ?>
		<?php echo TbHtml::activeCheckBoxList($model,'mobileNetworks', Layer::getMobileNetworkOptions()); ?>
		<?php echo $form->error($model,'mobileNetworks'); ?>
</div>

<div class="row">
		<?php echo $form->labelEx($model,'otherMobileNetwork'); ?>
		<?php echo $form->textField($model,'otherMobileNetwork'); ?>
		<?php echo $form->error($model,'otherMobileNetwork'); ?>
 </div>

<div class="row">
		<?php echo $form->labelEx($model,'sourceOfWater'); ?>
		<?php echo TbHtml::activeCheckBoxList($model,'sourceOfWater', Layer::getSourceOfWaterOptions()); ?>
		<?php echo $form->error($model,'sourceOfWater'); ?>
</div>


<div class="row">
		<?php echo $form->labelEx($model,'otherSourceOfWater'); ?>
		<?php echo $form->textField($model,'otherSourceOfWater'); ?>
		<?php echo $form->error($model,'otherSourceOfWater'); ?>
 </div>

<div class="row">
		<?php echo $form->labelEx($model,'toiletFacility'); ?>
		<?php echo TbHtml::activeCheckBoxList($model,'toiletFacility', Layer::getToiletFacilityOptions()); ?>
		<?php echo $form->error($model,'toiletFacility'); ?>
</div>

<div class="row">
		<?php echo $form->labelEx($model,'toiletRemarks'); ?>
		<?php echo $form->textField($model,'toiletRemarks'); ?>
		<?php echo $form->error($model,'toiletRemarks'); ?>
 </div>

<div class="row">
		<?php echo $form->labelEx($model,'wasteManagement'); ?>
		<?php echo TbHtml::activeCheckBoxList($model,'wasteManagement', Layer::getWasteManagementOptions()); ?>
		<?php echo $form->error($model,'wasteManagement'); ?>
</div>

<div class="row">
		<?php echo $form->labelEx($model,'otherWasteManagement'); ?>
		<?php echo $form->textField($model,'otherWasteManagement'); ?>
		<?php echo $form->error($model,'otherWasteManagement'); ?>
 </div>
