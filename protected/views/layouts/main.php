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
        <link rel="stylesheet" type="text/css" href="<?php //echo Yii::app()->request->baseUrl;    ?>/css/screen.css" media="screen, projection" />
        <link rel="stylesheet" type="text/css" href="<?php //echo Yii::app()->request->baseUrl;    ?>/css/print.css" media="print" />
        <!--[if lt IE 8]>
        <link rel="stylesheet" type="text/css" href="<?php //echo Yii::app()->request->baseUrl;    ?>/css/ie.css" media="screen, projection" />
        <![endif]-->

        <link rel="stylesheet" type="text/css" href="<?php //echo Yii::app()->request->baseUrl;    ?>/css/main.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
        <link rel="stylesheet" type="text/css" href="<?php //echo Yii::app()->request->baseUrl;    ?>/css/bootstrapfix.css" />

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
                    'brandLabel' => '<strong><span style="color:#47ADCB">MFL</span>Curation Tool</strong>',
                    'display' => TbHtml::NAVBAR_DISPLAY_FIXEDTOP,
                    'items' => array(
                        array(
                            'class' => 'bootstrap.widgets.TbNav',
                            'items' => array(
                                array('label' => 'Home', 'icon' => TbHtml::ICON_HOME, 'url' => array('/site/index'), 'visible' => !Yii::app()->user->isGuest),
                                //array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
                                // array('label'=>'Contacts', 'url'=>array('/site/contact')),
                                array('label' => 'Facilities', 'icon' => TbHtml::ICON_BRIEFCASE, 'url' => array('/curation/facilities'), 'visible' => Yii::app()->user->checkAccess('Request Change Privilege')),
                                array('label' => 'Pending Requests', 'icon' => TbHtml::ICON_REFRESH, 'url' => array('/curation/pendingRequests'), 'visible' => Yii::app()->user->checkAccess('Approval Change Privilege')),
                                array('label' => 'Login', 'url' => array('/site/login'), 'visible' => Yii::app()->user->isGuest),
                                array('label' => 'System Settings', 'icon' => TbHtml::ICON_WRENCH, 'url' => '#', 'visible' => Yii::app()->user->checkAccess('Administrator'),
                                    'items' => array(
                                        array('label' => 'User Accounts', 'url' => array('user/admin'), 'visible' => Yii::app()->user->checkAccess('Administrator')),
                                        array('label' => 'User Privileges', 'url' => array('authItem/roles'), 'visible' => Yii::app()->user->checkAccess('Administrator')),
                                    )),
                                array('label' => 'Logout (' . Yii::app()->user->name . ')', 'icon' => TbHtml::ICON_USER, 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest),
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
                Copyright &copy; <?php echo date('Y'); ?> by UCC.<br/>
                All Rights Reserved.<br/>
<?php //echo Yii::powered();  ?>
            </div><!-- footer -->

        </div><!-- page -->

    </body>
</html>
