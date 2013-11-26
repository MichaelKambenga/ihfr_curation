<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>
<?php if((Yii::app()->user->getState('active')== User::INACTIVE) && !Yii::app()->user->isGuest):?>
<div class="well">
<?php echo TbHtml::link("Click here to complete your profile to be granted privileges", 
        $this->createUrl('user/update',array('id'=>Yii::app()->user->getState('user_id'))), 
        array('class'=>'btn btn-danger'))?>
</div>
<?php endif; ?>
<?php echo TbHtml::heroUnit(CHtml::encode(Yii::app()->name),
        'Facility Curation Tool which works on top of InSTEDD ResourceMap'
        .'<br />'
        .TbHtml::button('Learn more',
array('color' => TbHtml::BUTTON_COLOR_INFO, 'size' => TbHtml::BUTTON_SIZE_LARGE))
        );
        ?>
 