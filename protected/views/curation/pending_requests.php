<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<?php echo TbHtml::pageHeader('', 'Pending Change Requests')?>

<div class="well" >
    
    <?php 
        echo TbHtml::button('<strong>Existing Facilities</strong>',
        array('block' => true, 
        'color' => TbHtml::BUTTON_COLOR_PRIMARY, 
        'size'=>TbHtml::BUTTON_SIZE_LARGE)); 
    ?>
   
   <?php
   $this->widget('zii.widgets.jui.CJuiAccordion', array(
       'panels' => array(
           'Facility 1,(Luhn_ID:-1-234-46859,Location:-Dar es salaam),Date Requested:-02-09-203,Requested By:-John' => '',
           'Facility 1,(Luhn_ID:-1-234-46860,Location:-Dodoma),Date Requested:-02-09-203,Requested By:-Robert' => '',
           'Facility 1,(Luhn_ID:-1-234-46861,Location:-Mwanza),Date Requested:-02-09-203,Requested By:-Charles' => '',
       ),
       'options' => array(
           'collapsible' => true,
           'active' => 0,
       ),
       'htmlOptions' => array(
           'style' => 'width:100%;'
       ),
   ));
   ?>
    
 <br />
 <br />
 
    <?php 
        echo TbHtml::button('<strong>New Facilities</strong>',
        array(
        'block' => true, 
        'color' => TbHtml::BUTTON_COLOR_PRIMARY, 
        'size'=>TbHtml::BUTTON_SIZE_LARGE)); 
    ?>
   
   <?php
   $this->widget('zii.widgets.jui.CJuiAccordion', array(
       'panels' => array(
           'Facility 1,(Luhn_ID:-1-234-46859,Location:-Dar es salaam),Date Requested:-02-09-203,Requested By:-John' => '',
           'Facility 1,(Luhn_ID:-1-234-46860,Location:-Dodoma),Date Requested:-02-09-203,Requested By:-Robert' => '',
           'Facility 1,(Luhn_ID:-1-234-46861,Location:-Mwanza),Date Requested:-02-09-203,Requested By:-Charles' => '',
       ),
       'options' => array(
           'collapsible' => true,
           'active' => 0,
       ),
       'htmlOptions' => array(
           'style' => 'width:100%;'
       ),
   ));
   ?>
    
</div>
