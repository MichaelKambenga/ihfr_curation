<?php
/* @var $this ChangeRequestNoteController */
/* @var $model ChangeRequestNote */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'change-request-note-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>
        <div class="row">
            <?php if($actionType == 'approve'):?>
            <span id="approve-status<?php echo $id?>"></span>
           <?php else:?>
            <span id="reject-status<?php echo $id?>"></span>
           <?php endif;?>
        </div>
	<div class="row">
		<?php echo $form->labelEx($model,'note'); ?>
		<?php echo $form->textArea($model,'note',array('style'=>'width:350px;height:100px;')); ?>
		<?php echo $form->error($model,'note'); ?>
	</div>

	<div class="row buttons">
            <?php if($actionType =='reject'):?>
            <?php echo TbHtml::ajaxSubmitButton('Confirm Reject',$this->createUrl('curation/reject',array('id'=>$id)),
                    array(
                        'type'=>'POST',
                        //'update'=>'#reject-status'.$id,
                        'success'=>"function(response,status){
                            $('#'+'reject-status'+'$id').html(response);
                            location.reload();
                          }"
                        
                    ),
                    array('class'=>'btn btn-info')) ?>
	    <?php elseif($actionType == 'approve'):?>
            <?php echo TbHtml::ajaxSubmitButton('Confirm Approval', $this->createUrl('curation/approve',array('id'=>$id)),
                     array(
                        'type'=>'POST',
                        //'update'=>'#approve-status'.$id,
                        'success'=>"function(response,status){
                            $('#'+'approve-status'+'$id').html(response);
                            location.reload();
                          }"
                       
                    ),
                    array('class'=>'btn btn-info')) ?>
            <?php endif;?>
        </div>

<?php $this->endWidget(); ?>

</div><!-- form -->