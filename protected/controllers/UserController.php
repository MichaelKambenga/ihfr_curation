<?php

class UserController extends Controller {
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update','LoadHierarchy'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete', 'assignRoles'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new User;
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    
    public function actionLoadHierarchy(){
        
        $hierarchyModel = SystemCache::model()->findByAttributes(array('name'=>'hierarchy'));
        $hierarchyArray = CJSON::decode($hierarchyModel->value);
        $data = Layer::parseHierarchy($hierarchyArray['config']['hierarchy']);
        $this->widget('CTreeView',array(
                    'id'=>'tree-node-id',
                    'data'=>$data,
                    'control'=>'#treecontrol',
                    'animated'=>'fast',
                    'collapsed'=>true,
                    'htmlOptions'=>array(
                    'class'=>'treeview-gray',
                                    ) 
                              ) 
                     );
    }
    
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
       
        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            if ($model->save()) {
                //$this->redirect(array('view','id'=>$model->id));
                if (!empty($_GET['asDialog'])) {
                    //Close the dialog, reset the iframe and update the grid
                    echo CHtml::script("window.parent.$('#edit-dialog').dialog('close');window.parent.$('#edit-frame').attr('src','');window.parent.$.fn.yiiGridView.update('{$_GET['gridId']}');");
                    Yii::app()->end();
                }
            }
        }
        if (!empty($_GET['asDialog']))
            $this->layout = '//layouts/iframe';

        $this->render('update', array(
            'model' => $model
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('User');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new User('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['User']))
            $model->attributes = $_GET['User'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return User the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = User::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param User $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /**
     * Assigning Roles to the Users of the Sysytem
     */
    public function actionAssignRoles($id, $email) {

        $criteria = new CDbCriteria;
        $criteria->compare('userid', $id);

        if (isset($_POST['submit'])) {

            AuthAssignment::model()->deleteAll($criteria);

            if (isset($_POST['name'])) {
                foreach ($_POST['name'] as $var) {
                    if ($var != 1) {
                        $auth = Yii::app()->authManager; //Initialing The Authentication Manager
                        $auth->assign($var, $id);
                    }
                }
            }

            $success = "Roles were assigned/revoked successfully...";
            Yii::app()->user->setFlash('success', $success);
        } else {
            //AuthAssignment::model()->deleteAll($criteria);
            $info = "Please, select at least one role for the user.";
            Yii::app()->user->setFlash('info', $info);
        }

        $dataProvider = AuthItem::getRoles();
        $this->render('batch', array(
            'dataProvider' => $dataProvider, 'id' => $id, 'email' => $email
        ));
    }

}
