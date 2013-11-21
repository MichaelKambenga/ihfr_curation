<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php
$this->breadcrumbs=array(
	'Sites'=>array('facilities'),
	'Create/Update',
);
?>

<?php echo TbHtml::pageHeader('',isset($model->_1814)?'Update Site':'Create Site'); ?>
<div class="form well">
 <?php if(Yii::app()->user->hasFlash('failure')):?>
<div class="alert alert-error">
      <?php echo Yii::app()->user->getFlash('failure');?>
</div>
<?php endif;?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'site-form',
	'enableAjaxValidation'=>false,
)); ?>
    
<div style="width:70%;">
<?php echo $form->errorSummary($model); ?>
</div>
<?php 
      
     ob_start();
     $this->renderPartial('_layers_remarks_form',array('model'=>$model,'form'=>$form));
     $remarksView = ob_get_contents();
     ob_end_clean();
     
     ob_start();
     $this->renderPartial('_layers_mainfields_form',array('model'=>$model,'form'=>$form));
     $mainFieldsView = ob_get_contents();
     ob_end_clean();
     
     //Note field---for curation purposes
     $layers['Remarks'] = $remarksView;
     
     $layers['Name and Location'] = $mainFieldsView;
     
     $this->widget('zii.widgets.jui.CJuiAccordion', array(
                            'id'=>'accordion',
                            'panels'=>$layers,
                            'options' => array(
                                'collapsible' => true,
                                'active' => 0,
                                'clearStyle'=>true,
                                'fillSpace'=>false,
                            ),
                            'htmlOptions' => array(
                                'style' => 'width:70%;'
                            ),
                        ));
?>

    <div class="row buttons">
        <?php echo CHtml::submitButton(isset($model->_1814)?'Send Site Update Request':'Send Site Create Request',array('class'=>'btn btn-info')); ?>
    </div>

<?php $this->endWidget();?>

</div><!-- form -->

<script language ="javascript">
    $("li a").click(
        function(){
           
            $("#"+$(this).closest('div').children('label').attr('for')).val(this.id);
            //clear previously selected
            $(this).closest('div').find('a').each(
                      function(){
                          $(this).css('background-color','#fff');
                          $(this).children(0).attr('class','icon-folder-close');
                      }
            );
            $(this).css('background-color','#ccc');
            $(this).css('color','#000');
            $(this).children(0).attr('class','icon-folder-open');
            
        }
        
  );
  
$(document).ready(function(){
   
   $(".hierarchy-field input").each(function(){
        var identifier = $(this).val();
        $("#"+identifier).css('background-color','#ccc');
        $("#"+identifier).css('color','#000');
        $("#"+identifier).children(0).attr('class','icon-folder-open');  
   }
   
   
   );
});

  
  
</script>