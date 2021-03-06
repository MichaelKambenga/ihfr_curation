<?php
/* @var $this Controller */
Yii::app()->bootstrap->register();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />
        <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/images/favicon.ico" type="image/x-icon" />
        <!-- blueprint CSS framework -->
        <!--<link rel="stylesheet" type="text/css" href="<?php //echo Yii::app()->request->baseUrl;    ?>/css/screen.css" media="screen, projection" />-->
        <!--<link rel="stylesheet" type="text/css" href="<?php //echo Yii::app()->request->baseUrl;    ?>/css/print.css" media="print" />-->
        <!--[if lt IE 8]>
        <link rel="stylesheet" type="text/css" href="<?php //echo Yii::app()->request->baseUrl;    ?>/css/ie.css" media="screen, projection" />
        <![endif]-->

        <!--<link rel="stylesheet" type="text/css" href="<?php //echo Yii::app()->request->baseUrl;    ?>/css/main.css" />-->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
        <!--<link rel="stylesheet" type="text/css" href="<?php //echo Yii::app()->request->baseUrl;    ?>/css/bootstrapfix.css" />-->

        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    </head>

    <body>

        <div class="container" id="page">

            <div id="header">
                <div id="logo"><?php //echo CHtml::encode(Yii::app()->name);    ?></div>
            </div><!-- header -->

            <div id="mainmenu-mod">

                <?php
                ob_start();
                echo TbHtml::badge('2', array('color' => TbHtml::BADGE_COLOR_SUCCESS));
                $requestCount = ob_get_contents();
                ob_clean();

                $this->widget('bootstrap.widgets.TbNavbar', array(
                    'brandLabel' => '<strong><span style="color:#47ADCB">HFR</span>Curation Tool</strong>',
                    'display' => TbHtml::NAVBAR_DISPLAY_FIXEDTOP,
                    'items' => array(
                      !Yii::app()->user->isGuest?Notification::loadRequestsNotifier():"",
                        array(
                            'class' => 'bootstrap.widgets.TbNav',
                            'items' => array(
                                array('label' => 'Home', 'icon' => TbHtml::ICON_HOME, 'url' => array('/site/index'), 'visible' => !Yii::app()->user->isGuest),
                                //array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
                                // array('label'=>'Contacts', 'url'=>array('/site/contact')),
                                array('label' => 'Facilities', 'icon' => TbHtml::ICON_BRIEFCASE, 'url' => array('/curation/facilities'), 'visible' => Yii::app()->user->checkAccess('Request Change Privilege')),
                                array('label' => 'Pending Requests', 'icon' => TbHtml::ICON_REFRESH, 'url' => array('/curation/pendingRequests'), 'visible' => Yii::app()->user->checkAccess('Approval Change Privilege')),
                                array('label' => 'Login', 'url' => array('/site/openid/login/1'), 'visible' => Yii::app()->user->isGuest),
//                                array('label' => 'Notifications', 'icon' => TbHtml::ICON_ENVELOPE, 'url' => '#', 'visible' => !Yii::app()->user->isGuest,
//                                    'items' => array(
//                                        array('label' => 'My Requests', 'url' => array('changeRequest/MyRequests'), 'visible' => Yii::app()->user->checkAccess('Request Change Privilege')),
//                                        array('label' => 'My Approvals/Rejections', 'url' => array('changeRequest/MyApprovals'), 'visible' => Yii::app()->user->checkAccess('Approval Change Privilege')),
//                                    )),
                                array('label' => 'Settings', 'icon' => TbHtml::ICON_WRENCH, 'url' => '#', 'visible' => Yii::app()->user->checkAccess('Administrator'),
                                    'items' => array(
                                        array('label' => 'User Accounts', 'url' => array('user/admin'), 'visible' => Yii::app()->user->checkAccess('Administrator')),
                                        array('label' => 'User Privileges', 'url' => array('authItem/roles'), 'visible' => Yii::app()->user->checkAccess('Administrator')),
                                        array('label' => 'Positions', 'url' => array('position/admin'), 'visible' => Yii::app()->user->checkAccess('Administrator')),
                                        array('label' => 'Organizations', 'url' => array('organization/admin'), 'visible' => Yii::app()->user->checkAccess('Administrator')),
                                        array('label' => 'Audit Trail', 'url' => array('systemAudit/admin'), 'visible' => Yii::app()->user->checkAccess('Administrator')),
                                    )), 
                                  array('label' => 'Reconciliatons', 'icon' => TbHtml::ICON_ENVELOPE, 'url' => '#', 'visible' => Yii::app()->user->checkAccess('Administrator'),
                                    'items' => array(
                                        array('label' => 'Deleted Health Facilities', 'url' => array('/curation/deletedFacilities'), 'visible' => Yii::app()->user->checkAccess('Administrator')),
                                        array('label' => 'Unprocessed Requests', 'url' => array('curation/deletedFacilities'), 'visible' => Yii::app()->user->checkAccess('Administrator')),                                       
                                    )),  
                                array('label' => 'FAQs', 'url'=>array('/faqs/admin')),
                                array('label' => 'My Account', 'icon' => TbHtml::ICON_USER, 'url' => '#', 'visible' => !Yii::app()->user->isGuest,
                                    'items' => array(
                                        array('label' => 'Edit Account Details', 'url' => array('user/update','id'=>Yii::app()->user->getState('user_id')), 'visible' => !Yii::app()->user->isGuest),
                                        array('label' => 'Logout (' . Yii::app()->user->name . ')', 'icon' => TbHtml::ICON_USER, 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest),
                                    )),                  
                            ),
                        )
                    )
                        )
                );
                ?>
            </div><!-- mainmenu -->

            <br /><br /><br />

<?php if (isset($this->breadcrumbs)): ?>
                <?php
                $this->widget('zii.widgets.CBreadcrumbs', array(
                    'links' => $this->breadcrumbs,
                ));
                ?><!-- breadcrumbs -->

            <?php endif ?>

            <div class="clear"></div>

<?php echo $content; ?>

            <div class="clear"></div>

            <div id="footer" class="well" style="clear: both;">
                Copyright &copy; <?php echo date('Y'); ?> Ministry of Health and Social Welfare.<br/>
                All Rights Reserved.<br/>
<?php //echo Yii::powered();  ?>
            </div><!-- footer -->

        </div><!-- page -->

    </body>
</html>