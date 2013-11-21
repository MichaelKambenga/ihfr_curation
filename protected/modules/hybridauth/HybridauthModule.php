<?php

class HybridauthModule extends CWebModule {

	public $baseUrl;
	public $providers;
	public $withYiiUser;
	private $_assetsUrl;
	private $_hybridAuth;
	

	public function init() {
		// this method is called when the module is being created
		// you may place code here to customize the module or the application
		// import the module-level models and components
		$this->setImport(array(
			'hybridauth.models.*',
			'hybridauth.components.*',
		));
		require dirname(__FILE__) . '/Hybrid/Auth.php';
		$this->_hybridAuth = new Hybrid_Auth($this->getConfig());
	}


	public function beforeControllerAction($controller, $action) {
		if (parent::beforeControllerAction($controller, $action)) {
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}

	/**
	 * Handles publishing of the assets (images etc).
	 * @return string URL of assets folder
	 */
	public function getAssetsUrl() {
        if ($this->_assetsUrl === null) {
            $this->_assetsUrl = Yii::app()->getAssetManager()->publish(
                Yii::getPathOfAlias('application.modules.hybridauth.assets') 
			);
		}
		return $this->_assetsUrl;
    }
	
	/** 
	 * Convert configuration to an array for Hybrid_Auth, rather than object properties as supplied by Yii
	 * @return array
	 */
	public function getConfig() {
		return array(
			'baseUrl' => $this->baseUrl,
			'base_url' => $this->baseUrl . '/default/callback', // URL for Hybrid_Auth callback
			'providers' => $this->providers,
		);
	}
	
	/** 
	 * Returns the Hybrid_Auth class.  See Hybrid_Auth docs (http://hybridauth.sourceforge.net/userguide.html)
	 * for details of how to use this
	 * @return Hybrid_Auth
	 */
	public function getHybridAuth() {
		return $this->_hybridAuth;
	}
}
