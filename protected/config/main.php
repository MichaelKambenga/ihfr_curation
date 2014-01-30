<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'MFL Curation Tool',
    // preloading 'log' component
    'preload' => array('log'),
    'aliases' => array(
        'bootstrap' => realpath(__DIR__ . '/../extensions/bootstrap')
    ),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.extensions.*',
        'application.extensions.openID.*',
        'bootstrap.helpers.TbHtml',
    ),
    'modules' => array(
        // uncomment the following to enable the Gii tool
        
        'gii' => array(
            'generatorPaths' => array('bootstrap.gii'),
            'class' => 'system.gii.GiiModule',
            'password' => 'gii',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('127.0.0.1', '::1'),
        ),
    ),
    // application components
    'components' => array(
        'bootstrap' => array(
            'class' => 'bootstrap.components.TbApi',
        ),
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
        ),
        'cache'=>array(
            'class'=>'CMemCache',
        ),
        // uncomment the following to enable URLs in path-format
        /*
          'urlManager'=>array(
          'urlFormat'=>'path',
          'rules'=>array(
          '<controller:\w+>/<id:\d+>'=>'<controller>/view',
          '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
          '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
          ),
          ),
         */
        /*
        'db' => array(
            'connectionString' => 'sqlite:' . dirname(__FILE__) . '/../data/testdrive.db',
        ),
         */
        // uncomment the following to use a MySQL database
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=ihfr_curation',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => 'drobyg3',
            'charset' => 'utf8',
        ),
        /* Using the Database Authorization Manager */
        'authManager' => array(
            'class' => 'CDbAuthManager',
            'connectionID' => 'db',
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
            // uncomment the following to show log messages on web pages
            /*
              array(
              'class'=>'CWebLogRoute',
              ),
             */
            ),
        ),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'adminEmail' => 'webmaster@example.com',
        'api-domain'=>'http://resourcemap.instedd.org',
        'openidServerAddress'=>'http://login-stg.instedd.org/openid',
        'openidSignupPage'=>'http://login-stg.instedd.org/users/sign_up',
        'resourceMapConfig' => array(
            'api-username'=>'mkambenga@gmail.com',
            'api-password'=>'Michael',
            'public_collection_id' => '409',
            'curation_collection_id' => '463',
            'lower_bound_latitude'=>-3.8940,
            'upper_bound_latitude'=>-1.7478,
            'lower_bound_longitude'=>30.9889,
            'upper_bound_longitude'=>45.0809,
            
        ),
    ),
);
