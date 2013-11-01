<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php $fields = ChangeRequest::getFieldValues($model['id'])?>

<?php echo TbHtml::pageHeader('', 'View/Change Facility');?>
<div class="well">
      <?php if(Yii::app()->user->hasFlash('success')):?>
        <div class="alert alert-success">
              <?php echo Yii::app()->user->getFlash('success');?>
        </div>
    <?php endif;?>

<table>
<?php foreach($fields as $key=>$field):?>
    
<?php if(!is_array($field)):?>
<tr>
    <td><?php echo TbHtml::labelTb($key, array('color' => TbHtml::LABEL_COLOR_INFO))?></td>
    <?php //echo TbHtml::labelTb($field, array('color' => TbHtml::LABEL_COLOR_INFO)); ?>
    <?php //echo TbHtml::icon(TbHtml::ICON_ARROW_RIGHT) ?>
    <td><?php echo TbHtml::labelTb($field); ?></td>
</tr>

<?php else:?>
<tr>
    <td><?php echo TbHtml::labelTb($key, array('color' => TbHtml::LABEL_COLOR_INFO))?></td>
    <?php //echo TbHtml::labelTb($field, array('color' => TbHtml::LABEL_COLOR_INFO)); ?>
    <?php //echo TbHtml::icon(TbHtml::ICON_ARROW_RIGHT) ?>
    <?php $concatValues = "";?>
    <?php foreach($field as $value):?>
           <?php $concatValues.= $value.'<br />';?>
    <?php endforeach;?>
    <td><?php echo TbHtml::labelTb($concatValues); ?></td>
</tr>
   
      
<?php endif;?>

<?php endforeach;?>
<td></td>
<td><p></p><?php echo TbHtml::link('Update',$this->createUrl('curation/updateSite',array('id'=>$model['id'])),array('class'=>'btn btn-info'));?></td>
</table>
  
</div>

