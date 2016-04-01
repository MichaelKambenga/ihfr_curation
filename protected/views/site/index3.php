<?php
/* @var $this SiteController */

/*
     $connection = @fsockopen("41.217.202.50", 8080);
      if(is_resource($connection)){
         echo "Port is open";
          } else {
              echo "Port is not open";
          }
     echo "<br/>";
     die('Troubleshooting....');
  
   */    
 
        $uuidSiteModel = 'http://resourcemap.instedd.org/collections/409/fred_api/v1/facilities.json?identifiers.id=100020-7';
        $uuidSiteModelResponse = RestUtility::execCurl($uuidSiteModel);
        $uuidSiteModelResult = CJSON::decode($uuidSiteModelResponse, true);

        $properties = array();
        $properties['name'] = '512 KJ';
      
        $properties['uuid'] = $uuidSiteModelResult['facilities'][0]['uuid'];
        $json = CJSON::encode($properties);

        $dhisSiteUrl = 'http://41.217.202.50:8080/dhis/ohie/fred/v1/facilities/' . $uuidSiteModelResult['facilities'][0]['uuid'];
        echo $dhisSiteUrl."<br/>";
        $response = RestUtility::execDhisCurl($dhisSiteUrl);
        $results = CJSON::decode($response);
        echo "<pre>";print_r($results);die('Troubleshooting....');
        if ($results) {
            return;
        }


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
        .'<span>&nbsp;&nbsp;</span>'.TbHtml::link('Public Portal','http://hfrportal.ehealth.go.tz/',
array('target' => '_blank','class'=>'btn btn-large btn-danger'))
        .'<span>&nbsp;&nbsp;</span>'
        .$link = Yii::app()->user->isGuest?TbHtml::link('Sign up',Yii::app()->params['openidSignupPage'],
array('class'=>'btn btn-large btn-success')):''
        );
        ?>