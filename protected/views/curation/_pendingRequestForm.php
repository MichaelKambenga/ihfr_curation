
<?php $fields = ChangeRequest::getFieldValues($model->cc_site_id)?>

<?php foreach($fields as $key=>$field):?>

<?php if(!is_array($field)):?>
<div class="row">
    <?php echo TbHtml::labelTb($key, array('color' => TbHtml::LABEL_COLOR_INFO))?><br />
    <?php //echo TbHtml::labelTb($field, array('color' => TbHtml::LABEL_COLOR_INFO)); ?>
    <?php //echo TbHtml::icon(TbHtml::ICON_ARROW_RIGHT) ?>
    <?php echo TbHtml::labelTb($field); ?>
</div>
<br />
<?php else:?>
<div class="row">
    <?php echo TbHtml::labelTb($key, array('color' => TbHtml::LABEL_COLOR_INFO))?><br />
    <?php //echo TbHtml::labelTb($field, array('color' => TbHtml::LABEL_COLOR_INFO)); ?>
    <?php //echo TbHtml::icon(TbHtml::ICON_ARROW_RIGHT) ?>
    <?php $concatValues = "";?>
    <?php foreach($field as $value):?>
           <?php $concatValues.= $value.'<br />';?>
    <?php endforeach;?>
    <?php echo TbHtml::labelTb($concatValues); ?>
</div>
<br />     
      
<?php endif;?>

<?php endforeach;?>
<div class="row">
 <?php 
    echo TbHtml::button('Cancel');
 ?>
    <span>&nbsp;</span>
 <?php 
    echo TbHtml::button('Accept',array('class'=>'btn btn-info'));
  ?>
</div>
<br />

