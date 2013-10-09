


<div class="row">
    <?php echo TbHtml::labelTb('Name')?>
    <?php echo TbHtml::labelTb('Morogoro', array('color' => TbHtml::LABEL_COLOR_INFO)); ?>
    <?php echo TbHtml::icon(TbHtml::ICON_ARROW_RIGHT) ?>
    <?php echo TbHtml::labelTb('Dar es salaam', array('color' => TbHtml::LABEL_COLOR_SUCCESS)); ?>
</div>
<br />

<div class="row">
    <?php echo TbHtml::labelTb('Ownership')?>
    <?php echo TbHtml::labelTb('Private', array('color' => TbHtml::LABEL_COLOR_INFO)); ?>
    <?php echo TbHtml::icon(TbHtml::ICON_ARROW_RIGHT) ?>
    <?php echo TbHtml::labelTb('Non-Profit', array('color' => TbHtml::LABEL_COLOR_SUCCESS)); ?>
</div>
<br />

<div class="row">
    <?php echo TbHtml::labelTb('Facilty Type')?>
    <?php echo TbHtml::labelTb('Dispensary', array('color' => TbHtml::LABEL_COLOR_INFO)); ?>
    <?php echo TbHtml::icon(TbHtml::ICON_ARROW_RIGHT) ?>
    <?php echo TbHtml::labelTb('Regional Hospital', array('color' => TbHtml::LABEL_COLOR_SUCCESS)); ?>
</div>
<br />

<div class="row">
 <?php 
    echo TbHtml::button('Cancel');
 ?>
    <span>&nbsp;</span>
 <?php 
    echo TbHtml::button('Accept',array('class'=>'btn btn-info'));
  ?>
</div>

