<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
 
?>
<?php 
ob_start();
  echo  TbHtml::badge('2', array('color' => TbHtml::BADGE_COLOR_SUCCESS));
  $requestCount = ob_get_contents();
ob_clean();
?>
<?php echo TbHtml::pageHeader('', 'Pending Change Requests')?>

<div class="well" >
    
    <?php 
        echo TbHtml::button('<strong>Change Requests</strong>',
        array('block' => true, 
        'color' => TbHtml::BUTTON_COLOR_PRIMARY, 
        'size'=>TbHtml::BUTTON_SIZE_LARGE,
                )); 
        
    ?>
   
   <?php
   
   $panels = array();
   foreach($models as $model){
       ob_start();
       $this->renderPartial('_pendingRequestForm',array('model'=>$model));
       $view = ob_get_contents();
       ob_end_clean();
       $panels["(Luhn-ID:{$model->primary_site_code}"." "."Requested By:{$model->requestedBy->email})"." "."Date:{$model->requested_date}"] = $view;
   }
   
   $this->widget('zii.widgets.jui.CJuiAccordion', array(
       'panels'=>$panels,
       'options' => array(
           'collapsible' => true,
           'active' => 0,
//           'clearStyle'=>true,
//           'fillSpace'=>true,
       ),
       'htmlOptions' => array(
           'style' => 'width:100%;'
       ),
   ));
   ?>
    
</div>

