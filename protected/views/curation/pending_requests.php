<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
 
?>
<?php 
  $requestCount = TbHtml::badge(ChangeRequest::model()->count('status=:status',array(':status'=>  ChangeRequest::STATUS_PENDING)), 
          array('color' => TbHtml::BADGE_COLOR_SUCCESS));

?>
<?php echo TbHtml::pageHeader('', 'Pending Change Requests')?>

<div class="well" >
    
    <?php 
        echo TbHtml::button("<strong>Change Requests</strong> $requestCount",
        array('block' => true, 
        'color' => TbHtml::BUTTON_COLOR_PRIMARY, 
        'size'=>TbHtml::BUTTON_SIZE_LARGE,
                )); 
        
    ?>
   
   <?php
   
   $panels = array();
   foreach($models as $model){
       $typeTag = 'UNKNOWN';
       if($model->request_type == ChangeRequest::TYPE_CREATE){
           $typeTag = TbHtml::badge('NEW', array('color'=>  TbHtml::BADGE_COLOR_SUCCESS));
       }
       elseif($model->request_type == ChangeRequest::TYPE_UPDATE){
           $typeTag = TbHtml::badge('UPDATE', array('color'=>  TbHtml::BADGE_COLOR_DEFAULT));
       }
       elseif($model->request_type == ChangeRequest::TYPE_DELETE){
           $typeTag = TbHtml::badge('DELETE', array('color'=>  TbHtml::BADGE_COLOR_WARNING));
       }
       ob_start();
       $this->renderPartial('_pendingRequestForm',array('model'=>$model));
       $view = ob_get_contents();
       ob_end_clean();
       $panels["(Luhn-ID:{$model->primary_site_code}"." "."Requested By:{$model->requestedBy->email})"." "."Date:{$model->requested_date}"." $typeTag"] = $view;
   }
   
   $this->widget('zii.widgets.jui.CJuiAccordion', array(
       'panels'=>$panels,
       'options' => array(
           'collapsible' => true,
           'active' => 0,
           'clearStyle'=>true,
           'fillSpace'=>true,
       ),
       'htmlOptions' => array(
           'style' => 'width:100%;'
       ),
   ));
   ?>
    
</div>

