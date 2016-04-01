<?php
//        $note = ChangeRequestNote::model()->findByAttributes(array('change_request_id' => 1760));
//        $hfr_site_name = 'Testing HF';
//        $hfr_site_id = '111335-6';
//        $message = "Dear Team,\r\n The Health Facility with the following details   has been deleted in HFR \r\n Facility Name:-" . $hfr_site_name . " \r\n Facility ID:- " . $hfr_site_id . " \r\n Reason for Deletion being:- " . $note->note . " \r\n Thanks,\r\n From HFR Team";
//        $subject = "Deletion of Health Facility in HFR";
//        $headers = 'From:HFR Team(hfr@moh.go.tz)' . "\r\n";
//        mail(Yii::app()->params['adminEmail'], $subject, $message, $headers);     
/* @var $this SiteController */


/*
//        $michael = substr('TZ.CL.DO.BA.6.9.3',0,13);
//        echo $michael .' =>';
        
        $council = HfrDhisMapping::model()->findByAttributes(array('hfr_id' => 'TZ.LK.MZ.IM.6')); 
        $properties = array();
        $properties['name'] = 'ZZZ Tetsting Health Facility';
        $properties['active'] = true;
        $properties['coordinates'] = [32.90191, -2.51685];

        $hfr_identifier = array();
        $hfr_identifier['agency'] = 'DHIS2';
        $hfr_identifier['context'] = 'DHIS2_CODE';
        $hfr_identifier['id'] = '111077-4';
        $properties['identifiers'] = [ $hfr_identifier];

        $properties['uuid'] = 'b8657037-b368-4b8c-8939-819ce654a3af';

        $facility_properties = array();
        $facility_properties['ownership'] = 'qNeP2XrYR0d';
        $facility_properties['parent'] = 'et6lWc8GDHy';
        $facility_properties['type'] = 'DvJehvyBpEQ';       
        
        $properties['properties'] = $facility_properties;

        $json = CJSON::encode($properties);

       echo $json;
        die('Hapaaaaaa');

*/

//$connection = @fsockopen("41.217.202.50", "8080");
//if (is_resource($connection)) {
//    echo "Port is open";
//} else {
//    echo "Port is not open";
//}
//
//die();
/*
  $uuidSiteModel = 'http://resourcemap.instedd.org/collections/409/fred_api/v1/facilities.json?identifiers.id=100020-7';
  $uuidSiteModelResponse = RestUtility::execCurl($uuidSiteModel);
  $uuidSiteModelResult = CJSON::decode($uuidSiteModelResponse, true);

  $properties = array();
  $properties['name'] = '512 KJ';

  $properties['uuid'] = $uuidSiteModelResult['facilities'][0]['uuid'];
  $json = CJSON::encode($properties);

  //        $dhisSiteUrl = 'http://41.217.202.50:8080/dhis/ohie/fred/v1/facilities/' . $uuidSiteModelResult['facilities'][0]['uuid'];

  $dhisSiteUrl = 'http://41.217.202.50:8080/dhis/api/facilities/metadata?lastUpdated=2014-02';
  echo $dhisSiteUrl."<br/>";
  $response = RestUtility::execDhisCurl($dhisSiteUrl);
  $results = CJSON::decode($response);
  echo "<pre>";print_r($results);die('Troubleshooting....');
  if ($results) {
  return;
  }
 */
 

$this->pageTitle = Yii::app()->name;
?>
<img src="<?php echo Yii::app()->request->baseUrl ?>/images/logo.jpg"/><img src="<?php echo Yii::app()->request->baseUrl ?>/images/banner.jpg" />
<p></p>
    <?php if ((Yii::app()->user->getState('active') == User::INACTIVE) && !Yii::app()->user->isGuest): ?>
    <div class="well">
        <?php
        echo TbHtml::link("Click here to complete your profile to be granted privileges", $this->createUrl('user/update', array('id' => Yii::app()->user->getState('user_id'))), array('class' => 'btn btn-danger'))
        ?>
    </div>
<?php endif; ?>

    <?php if ((Yii::app()->user->getState('active') == User::ACTIVE) && !Yii::app()->user->isGuest && !User::hasAccess() && !Yii::app()->user->hasFlash('completed_profile_msg')): ?>
    <div>
        <?php
        echo TbHtml::alert(TbHtml::ALERT_COLOR_WARNING, 'Your activation by the system administrator is pending...please be patient');
        ?>
    </div>
<?php endif; ?>

    <?php if ((Yii::app()->user->hasFlash('completed_profile_msg'))): ?>
    <div>
        <?php
        echo TbHtml::alert(TbHtml::ALERT_COLOR_SUCCESS, Yii::app()->user->getFlash('completed_profile_msg'));
        ?>
    </div>
<?php endif; ?>

<?php
echo TbHtml::heroUnit(CHtml::encode(Yii::app()->name), ''
        . '<br />'
        . TbHtml::link('Learn more', $this->createUrl('site/page', array('view' => 'about')), array('class' => 'btn btn-large btn-info'))
        . '<span>&nbsp;&nbsp;</span>' . TbHtml::link('Public Portal', 'http://hfrportal.ehealth.go.tz/', array('target' => '_blank', 'class' => 'btn btn-large btn-danger'))
        . '<span>&nbsp;&nbsp;</span>'
        . $link = Yii::app()->user->isGuest ? TbHtml::link('Sign up', Yii::app()->params['openidSignupPage'], array('class' => 'btn btn-large btn-success')) : ''
);
?>
