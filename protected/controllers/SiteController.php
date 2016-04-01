<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
            
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}
        
        public function actionOpenid(){            
            try{  
                $openid = new LightOpenID(Yii::app()->request->serverName.':8080');
//                echo Yii::app()->request->serverName.'<br/>';
//                print_r($openid);die();
                if(!$openid->mode){
                     
                    if(isset($_GET['login'])){                        
                        $openid->identity = Yii::app()->params['openidServerAddress'];
                        $openid->required = array(
                            'contact/email',
                        );
                        header('Location: '.$openid->authUrl());
                    }
                }elseif($openid->mode == 'cancel'){
                    $this->redirect(array('site/login'));
                }else{
                    
                    if($openid->validate()){
                        //echo '<pre>';print_r($openid);die;
                        $attributes = $openid->getAttributes();
                        $user_check = User::model()->findByAttributes(array(
                            'openid_identity'=>$openid->identity
                        ));
                                
                        if($user_check == null){
                            $new_user = new User();
                            $new_user->email = $attributes['contact/email'];
                            $new_user->openid_identity = $openid->identity;
                            if($new_user->validate()){
                                $new_user->save();
                            }
                        }
                        
                        $identity = new OpenIDUserIdentity($attributes['contact/email'], '');
                        $identity->authenticate();
                        if($identity->errorCode === OpenIDUserIdentity::ERROR_NONE){
                            $duration = 0;
                            Yii::app()->user->login($identity,$duration);
                        }
                        
                        $this->redirect(Yii::app()->homeUrl);
                        
                    }else{
                         $this->redirect(array('site/login'));
                    }
                }
                
            }catch(Exception $ex){
                echo TbHtml::alert(TbHtml::ALERT_COLOR_ERROR, $ex->getMessage());
            }
        }

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
                header('Location: '."https://login.instedd.org/users/sign_out?http://curation-stg.ucchosting.co.tz/");
             // $this->redirect(Yii::app()->homeUrl);  
	}
        
}