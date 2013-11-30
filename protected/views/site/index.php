<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>
<img src="<?php echo Yii::app()->request->baseUrl?>/images/logo.jpg"/><img src="<?php echo Yii::app()->request->baseUrl?>/images/banner.jpg" />
<p></p>
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
        .TbHtml::link('Learn more',$this->createUrl('site/page',array('view'=>'about')),
array('class'=>'btn btn-large btn-info'))
        .'<span>&nbsp;&nbsp;</span>'
        .$link = Yii::app()->user->isGuest?TbHtml::link('Sign up',Yii::app()->params['openidSignupPage'],
array('class'=>'btn btn-large btn-success')):''
        );
        ?>
