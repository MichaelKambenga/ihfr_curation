<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;

?>


<?php echo TbHtml::heroUnit(CHtml::encode(Yii::app()->name),
        'Facility Curation Tool which works on top of InSTEDD ResourceMap'
        .'<br />'
        .TbHtml::button('Learn more',
array('color' => TbHtml::BUTTON_COLOR_INFO, 'size' => TbHtml::BUTTON_SIZE_LARGE))
        )?>
  