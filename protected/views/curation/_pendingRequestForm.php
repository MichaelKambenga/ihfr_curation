
<?php $fields = ChangeRequest::getFieldValues($model->cc_site_id)?>

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
<tr >
<td></td>
<td><?php echo TbHtml::button('Cancel');?><span>&nbsp;&nbsp;</span><?php echo TbHtml::button('Accept',array('class'=>'btn btn-info'));?></td>
</tr>
</table>
<br />

