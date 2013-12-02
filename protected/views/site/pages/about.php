<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - About';
$this->breadcrumbs=array(
	'About',
);
?>
<?php echo TbHtml::pageHeader('','About'); ?>
<?php if(!Yii::app()->user->isGuest):?>
<p>
The Online Health Facility Registry is an online tool for stakeholders and the general public to view lists and maps of health facilities in mainland Tanzania, to search, zoom and filter these lists and maps in various ways, to view core characteristics and attributes of the health facilities, to download lists, and to view the official Registry ID for health facilities.

This curation tool is a tool to facilitate collaboration between the Ministry of Health and Social Welfare with Local Government Authorities and partners to keep the Master Health Facility List in the Online Health Facility Registry accurate and up to date.
</p>
<p>
To request the addition of a new facilities go <?php echo TbHtml::link('here',$this->createUrl('curation/createSite'), array('class'=>'btn btn-info'))?>
</p>
<p>
To request an update to a facility, first search for the facility <?php echo TbHtml::link('here',$this->createUrl('curation/facilities'), array('class'=>'btn btn-success'))?>
</p>
<p>
Changes that you make, if approved by MOHSW, will appear in the Online Health Facility Registry.

For general inquiries, please email "hfr.moh at moh dot go dot tz" or "hfr.moh at gmail dot com" (email address disguised to prevent automated spam).
</p>
<?php else :?>
<p>
    The Online Health Facility Registry is an online tool for stakeholders and the general public to view lists and maps of health facilities in mainland Tanzania, to search, zoom and filter these lists and maps in various ways, to view core characteristics and attributes of the health facilities, to download lists, and to view the official Registry ID for health facilities.
</p>
<p>
This curation tool is a tool to facilitate collaboration between the Ministry of Health and Social Welfare with Local Government Authorities and partners to keep the Master Health Facility List in the Online Health Facility Registry accurate and up to date.

If you are an authorised officer of a Local Government Authority or other relevant officer or partner, you may request login access to the curation tool <?php echo TbHtml::link('here',$this->createUrl('site/login'), array('class'=>'btn btn-info'))?>
</p>
<p>
Users with login access may request to add new facilities and make updates and corrections to the list, and these changes, if approved by MOHSW, will appear in the Online Health Facility Registry.
</p>
<p>
For general inquiries, please email "hfr.moh at moh dot go dot tz" or "hfr.moh at gmail dot com" (email address disguised to prevent automated spam).
</p>
<?php endif;?>