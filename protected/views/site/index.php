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

<?php if((Yii::app()->user->getState('active')== User::ACTIVE) && !Yii::app()->user->isGuest && !User::hasAccess() && !Yii::app()->user->hasFlash('completed_profile_msg')):?>
<div>
<?php echo TbHtml::alert(TbHtml::ALERT_COLOR_WARNING, 
        'Your activation by the system administrator is pending...please be patient');
?>
</div>
<?php endif; ?>

<?php if((Yii::app()->user->hasFlash('completed_profile_msg'))):?>
<div>
<?php echo TbHtml::alert(TbHtml::ALERT_COLOR_SUCCESS, 
        Yii::app()->user->getFlash('completed_profile_msg'));
?>
</div>
<?php endif; ?>

<?php echo TbHtml::heroUnit(CHtml::encode(Yii::app()->name),
        ''
        .'<br />'
        .TbHtml::link('Learn more',$this->createUrl('site/page',array('view'=>'about')),
array('class'=>'btn btn-large btn-info'))
        .'<span>&nbsp;&nbsp;</span>'
        .$link = Yii::app()->user->isGuest?TbHtml::link('Sign up',Yii::app()->params['openidSignupPage'],
array('class'=>'btn btn-large btn-success')):''
        );
        ?>