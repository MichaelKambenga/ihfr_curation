<?php

class CurationController extends Controller {

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    public function accessRules() {

        return array(
            array(
                'allow',
                'actions' => array('DeleteSite', 'UpdateSite', 'CreateSite', 'Facilities', 'SearchFacility', 'viewFacility', 'view', 'DeletedFacilities', 'exportToExcel'),
                'roles' => array('Request Change Privilege'),
            ),
            array(
                'allow',
                'actions' => array('Reject', 'Approve', 'Facilities', 'pendingRequests', 'Approve2'),
                'roles' => array('Approval Change Privilege'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionViewFacility($id) {
        $this->render('facility', array('model' => $this->loadFacility($id, Yii::app()->params['resourceMapConfig']['curation_collection_id'])));
    }

    public function actionView($id) {
        $this->render('public_facility', array('model' => $this->loadFacility($id, Yii::app()->params['resourceMapConfig']['public_collection_id'])
        ));
    }

    public function loadFacility($id, $collection_id) {
        $url = Yii::app()->params['api-domain'] . "/en/collections/" .
                $collection_id .
                "/sites/$id.json";
        $response = RestUtility::execCurl($url);
        $result = CJSON::decode($response, true);

        return $result;
    }

    public function loadFacilityByPSC($psc, $collection_id) {
        $url = Yii::app()->params['api-domain'] . "/api/collections/" .
                $collection_id .
                ".json?Fac_IDNumber={$psc}";

        $response = RestUtility::execCurl($url);
        $result = CJSON::decode($response, true);

        return $result;
    }

    public function actionFacilities($node_id = null) {
        $url = Yii::app()->params['api-domain'] . "/api/collections/" .
                Yii::app()->params['resourceMapConfig']['public_collection_id'] . ".json?page=all&Admin_div[under]=" .
                Yii::app()->user->getState('node_id');

        if (isset($node_id))
            $url = Yii::app()->params['api-domain'] . "/api/collections/" .
                    Yii::app()->params['resourceMapConfig']['public_collection_id'] .
                    ".json?page=all&Admin_div[under]={$node_id}";
        $response = RestUtility::execCurl($url);
        $result = CJSON::decode($response, true);

        if ($result['message']) {
            throw new CHttpException(500, 'Internal server error. Please contact to the system administrator.');
        }

        $totalItemCount = (int) $result['count'];
        $totalPages = (int) $result['totalPages'] == 0 ? 1 : (int) $result['totalPages'];
        $pageSize = ceil($totalItemCount / $totalPages);

        $sites = new CArrayDataProvider($result['sites'], array(
            'totalItemCount' => $totalItemCount,
            'pagination' => array(
                'pageSize' => 20
            )
                )
        );
        if (Yii::app()->request->isAjaxRequest) {
            $this->renderPartial('_facilityGrid', array('sites' => $sites));
            Yii::app()->end();
        }

        $hierarchyCache = SystemCache::model()->findByAttributes(array('name' => 'hierarchy'));
        $result = CJSON::decode($hierarchyCache->value);
        $rootNode = Yii::app()->user->getState('node_id');
        $filteredData = Layer::search($result['config']['hierarchy'], 'id', $rootNode);
        $data = $this->parseHierarchy($filteredData);
        $this->render('exploreFacilities', array('data' => $data, 'sites' => $sites));
    }

    public function actionSearchFacility($code = '', $name = '') {
        $url = '';
        $node_id = Yii::app()->user->getState('node_id');
        if (!empty($code)) {
            $code = trim($code);
            $url = Yii::app()->params['api-domain'] . "/api/collections/" .
                    Yii::app()->params['resourceMapConfig']['public_collection_id'] .
                    ".json?page=all&Fac_IDNumber={$code}&Admin_div[under]={$node_id}";
        }
        if (!empty($name)) {
            $name = trim($name);
            $url = Yii::app()->params['api-domain'] . "/api/collections/" .
                    Yii::app()->params['resourceMapConfig']['public_collection_id'] .
                    ".json?search=" . str_replace(' ', '%20', $name) . "&page=all&Admin_div[under]={$node_id}";
        }
        $response = RestUtility::execCurl($url);
        $result = CJSON::decode($response, true);
        $totalItemCount = (int) $result['count'];
        $sites = new CArrayDataProvider($result['sites'], array(
            'totalItemCount' => $totalItemCount,
            'pagination' => array(
                'pageSize' => 20
            )
                )
        );

        $this->renderPartial('_facilityGrid', array('sites' => $sites));
    }

    public function parseHierarchy($hierarchy) {
        $treeArray = array();
        if (is_array($hierarchy)) {
            foreach ($hierarchy as $node) {
                if (is_array($node)) {
                    if (array_key_exists('name', $node)) {
                        if (array_key_exists('sub', $node)) {
                            $subNodes = $this->parseHierarchy($node['sub']);
                            $treeNodeArray = array('text' => '<span style="color:#000;">' . CHtml::link(TbHtml::icon(TbHtml:: ICON_FOLDER_CLOSE) . $node['name'], $this->createUrl('facilities', array('node_id' => $node['id']))) . '</span>', 'children' => $subNodes);
                        } else {
                            $treeNodeArray = array('text' => '<span style="color:#000;">' . CHtml::link(TbHtml::icon(TbHtml:: ICON_FOLDER_CLOSE) . $node['name'], $this->createUrl('facilities', array('node_id' => $node['id']))) . '</span>');
                        }
                        array_push($treeArray, $treeNodeArray);
                    }
                }
            }

            return $treeArray;
        }
    }

    public function actionPendingRequests() {
        $myPendingRequests = array();
        $criteria = new CDbCriteria();
        $criteria->compare('status', ChangeRequest::STATUS_PENDING);
        $criteria->limit = 5;
        $criteria->order = 'requested_date DESC';

        //Adding pagination to the result set
        $count = ChangeRequest::model()->count($criteria);
        $pages = new CPagination($count);
        $pages->pageSize = 5;
        $pages->applyLimit($criteria);

        $models = ChangeRequest::model()->findAll($criteria);

        foreach ($models as $model) {
            if ($this->hasApprovePrivilegesForRequest($model->requestedBy->node_id)) {
                array_push($myPendingRequests, $model);
            }
        }

        $this->render('pending_requests', array(
            'models' => $myPendingRequests,
            'pages' => $pages,
        ));
    }

    public function hasApprovePrivilegesForRequest($node_id) {

        $url = Yii::app()->params['api-domain'] . "/en/collections/" .
                Yii::app()->params['resourceMapConfig']['curation_collection_id'] . "/fields/" .
                FieldMapping::CC_HIERARCHY_FIELD_ID . "/hierarchy?under=" . Yii::app()->user->getState('node_id') . "&node={$node_id}";

        $isUnderFlag = RestUtility::execCurl($url);
        if ($isUnderFlag)
            return true;

        return false;
    }

    public function onSiteCreateRequest($event) {
        $this->raiseEvent('onSiteCreateRequest', $event);
    }

    public function afterSiteCreate($site) {
        if ($this->hasEventHandler('onSiteCreateRequest')) {
            $event = new CEvent($this, $site);
            $this->onSiteCreateRequest($event);
        }
    }

    public function logChangeRequest($event) {
        $model = new ChangeRequest();
        $site = $event->params;
        $model->note = $site['note'];
        $model->cc_site_id = $site['id'];
        $model->primary_site_code = isset($site['saved_properties'][FieldMapping::CC_PRIMARY_SITE_CODE]) ? $site['saved_properties'][FieldMapping::CC_PRIMARY_SITE_CODE] : '';
        $model->version_id = $site['version'];
        $model->requested_by = Yii::app()->user->getState('user_id');
        $model->request_type = $site['request_type'];
        $model->status = ChangeRequest::STATUS_PENDING;
        $model->requested_date = date('Y-m-d H:i:s');
        $model->primary_site_code = $event->params['saved_properties'][13273];
        $model->save();
        $this->logChangeRequestNote($model);
        $this->logChangeRequestFields($model->id, $site);
    }

    public function logChangeRequestNote($changeRequestModel) {
        $model = new ChangeRequestNote();
        $model->change_request_id = $changeRequestModel->id;
        $model->user_id = Yii::app()->user->getState('user_id');
        $model->note = $changeRequestModel->note;
        $model->save();
    }

    public function logChangeRequestFields($change_request_id, $site) {

        foreach ($site['saved_properties'] as $key => $value) {
            $model = new ChangeRequestFields();
            $model->change_request_id = $change_request_id;
            $model->field_id = $key;
            $model->save();
        }
    }

    public function actionCreateSite() {


        $model = new FacilityForm();

        if (isset($_POST['FacilityForm'])) {

            $url = Yii::app()->params['api-domain'] . "/en/collections/" .
                    Yii::app()->params['resourceMapConfig']['curation_collection_id'] .
                    "/sites.json";

            //capture form values
            $model->attributes = $_POST['FacilityForm'];
            $longitude = '';
            $latitute = '';
            $geoCodeArray = array();
            if (!empty($model->location)) {
                $geoCodeArray = explode(',', $model->location);
                $latitute = $geoCodeArray[0];
                $longitude = $geoCodeArray[1];
            }
            if ($model->validate()) {
                //prepare properties array
                $properties = array();
                foreach ($model->attributes as $key => $attribute) {
                    if ($key == 'note' || $key == 'location' || $key == 'name')
                        continue;
                    $properties[trim($key, '_')] = $attribute;
                }

                $data = array(
                    'name' => $model->name, //site name
                    'lat' => $latitute,
                    'lng' => $longitude,
                    'properties' => $properties,
                );
//                         echo '<pre>';print_r($data);die('Hapaaaaa');
                //convert data into json format 
                $json = CJSON::encode($data);

                $params = array('site' => $json);
                $response = RestUtility::execCurlPost($url, $params);
                $site = CJSON::decode($response);
                $site['note'] = $model->note;
                $site['request_type'] = ChangeRequest::TYPE_CREATE;
                $site['saved_properties'] = $site['properties'];
                if (isset($site['id'])) {

                    $this->onSiteCreateRequest = array($this, 'logChangeRequest');
                    $this->afterSiteCreate($site);
                    Yii::app()->user->setFlash('success', 'Site create request sent');
                    $this->logAudit("Sent a facility Create request");
                    $this->render('facility', array('model' => $site));
                    Yii::app()->end();
                } else {
                    $errors = CJSON::decode($response);
                    if (isset($errors['properties'])) {
                        foreach ($errors['properties'] as $error) {
                            foreach ($error as $key => $value) {
                                $model->addError("_$key", $value);
                            }
                        }
                    }

                    Yii::app()->user->setFlash('failure', 'Site create request failed');
                }
            }
        }


        $this->render('site_form', array('model' => $model, 'layers' => $this->generateCurationForm($model)));
    }

    public function actionUpdateSite($id) {

        $results = $this->loadFacilityByPSC($id, Yii::app()->params['resourceMapConfig']['curation_collection_id']);
        $site = $this->loadFacility($results['sites'][0]['id'], Yii::app()->params['resourceMapConfig']['curation_collection_id']
        );
        if (is_null($site)) {
            Yii::app()->user->setFlash('edit_message', 'The site you want to edit is missing in the curation collection...');
            $this->redirect(Yii::app()->request->urlReferrer);
        }
        $site_id = $site['id'];
        $form = new FacilityForm();
        $form->name = $site['name'];
        if (array_key_exists('lat', $site) && array_key_exists('lng', $site))
            $form->location = $site['lat'] . ',' . $site['lng'];
        if ($site) {
            foreach ($site['properties'] as $key => $value) {
                $form->setAttributes(array("_$key" => $value));
            }
        }

        if (isset($_POST['FacilityForm'])) {

            $form->attributes = $_POST['FacilityForm'];
            $longitude = '';
            $latitute = '';
            $geoCodeArray = array();
            if (!empty($form->location)) {
                $geoCodeArray = explode(',', $form->location);
                $latitute = $geoCodeArray[0];
                $longitude = $geoCodeArray[1];
            }
            if ($form->validate()) {
                $properties = array();
                foreach ($form->attributes as $key => $attribute) {
                    if ($key == 'note' || $key == 'location' || $key == 'name' || $key == '_' . FieldMapping::CC_PRIMARY_SITE_CODE)
                        continue;
                    //check for updated fields only and add them to properties array
                    if (isset($site['properties'][trim($key, '_')])) {
                        if ($form->attributes[$key] != $site['properties'][trim($key, '_')]) {
                            $properties[trim($key, '_')] = $attribute;
                        }
                    } else {
                        if ($form->attributes[$key] != null) {
                            $properties[trim($key, '_')] = $attribute;
                        }
                    }
                }

                $data = array(
                    'name' => $form->name, //site name
                    'lat' => $latitute,
                    'lng' => $longitude,
                );
                if (!empty($properties)) {
                    $data['properties'] = $properties;
                }

                //convert data into json format 
                $json = CJSON::encode($data);
                //echo $json;exit;
                $params = array('site' => $json);
                $url = Yii::app()->params['api-domain'] . "/en/collections/" .
                        Yii::app()->params['resourceMapConfig']['curation_collection_id'] .
                        "/sites/{$site_id}/partial_update";

                $response = RestUtility::execCurlPost($url, $params);
                $site = CJSON::decode($response);

                $site['note'] = $form->note;
                $site['request_type'] = ChangeRequest::TYPE_UPDATE;
                $site['saved_properties'] = $properties;
                $site['saved_properties'][FieldMapping::CC_PRIMARY_SITE_CODE] = $site['properties'][FieldMapping::CC_PRIMARY_SITE_CODE];
                if (isset($site['id'])) {

                    $this->onSiteCreateRequest = array($this, 'logChangeRequest');
                    $this->afterSiteCreate($site);
                    Yii::app()->user->setFlash('success', 'Site update request sent');
                    $this->logAudit("Sent a facility Update request for a facility with Primary Site Code " . $site['saved_properties'][FieldMapping::CC_PRIMARY_SITE_CODE]);
                    $this->redirect($this->createUrl('facilities'));
//                           $this->render('facility',array('model'=>$site));
                    Yii::app()->end();
                } else {
                    $errors = CJSON::decode($response);
                    if (isset($errors['properties'])) {
                        foreach ($errors['properties'] as $error) {
                            foreach ($error as $key => $value) {
                                $form->addError("_$key", $value);
                            }
                        }
                    }
                    Yii::app()->user->setFlash('failure', 'Site update request failed');
                }
            }//if(validate())
        }

        $this->render('site_form', array('model' => $form, 'layers' => $this->generateCurationForm($form)));
    }

    public function actionDeleteSite($psc, $pc_id) {

        if (Yii::app()->request->isAjaxRequest) {
            $remarks = $_POST["remarks"];
            if (empty($remarks)) {
                echo 'Please fill the reason for deletion';
                Yii::app()->end();
            }
            $result = $this->loadFacilityByPSC($psc, Yii::app()->params['resourceMapConfig']['curation_collection_id']);
            $cc_site_id = $result['sites'][0]['id'];
            $changeRequest = new ChangeRequest();
            $changeRequest->request_type = ChangeRequest::TYPE_DELETE;
            $changeRequest->primary_site_code = $psc;
            $changeRequest->cc_site_id = $cc_site_id;
            $changeRequest->pc_site_id = $pc_id;
            $changeRequest->status = ChangeRequest::STATUS_PENDING;
            $changeRequest->requested_date = date('Y-m-d H:i:s');
            $changeRequest->requested_by = Yii::app()->user->getState('user_id');
            if ($changeRequest->save()) {
                $note = new ChangeRequestNote();
                $note->change_request_id = $changeRequest->id;
                $note->user_id = Yii::app()->user->getState('user_id');
                $note->note = $remarks;
                $note->save();
                $this->logAudit("Sent a facility Delete request for a facility with Primary Site Code " . $changeRequest->primary_site_code);
                echo 'Site delete request sent';
            } else {
                echo 'Site delete request not sent';
            }
        }
    }

    public function generateCurationForm($formModel) {

        $fieldMappings = FieldMapping::model()->findAll();
        $layerMappings = LayerMapping::model()->findAll();
        $layers = array('Name and Location' => '');

        foreach ($fieldMappings as $fieldMapping) {

            $fieldDetails = CJSON::decode($fieldMapping->cc_field_structure, true);

            foreach ($layerMappings as $layerMapping) {
                if (!isset($layers[$layerMapping->layer_name])) {
                    $layers[$layerMapping->layer_name] = '';
                }

//                echo $fieldDetails['layer_id'].' => '.$layerMapping->cc_layer_id;die('Hapaaa');

                if ($fieldDetails['layer_id'] == $layerMapping->cc_layer_id) {
                    ob_start();
                    $this->generateFieldWidgets($fieldDetails, $formModel);
                    $layers[$layerMapping->layer_name] .= ob_get_contents();
                    ob_end_clean();
                }
            }
        }

        return $layers;
    }

    private function generateFieldWidgets($fieldDetails, $formModel) {
        switch ($fieldDetails['kind']) {
            case 'select_many':
                $options = array();
                foreach ($fieldDetails['config']['options'] as $option) {
                    $options[$option['id']] = $option['label'];
                }

                echo "<div class='row'>" .
                TbHtml::activeLabel($formModel, '_' . $fieldDetails['id']) .
                TbHtml::activeCheckBoxList($formModel, '_' . $fieldDetails['id'], $options) .
                TbHtml::error($formModel, '_' . $fieldDetails['id']) .
                "</div>";
                break;

            case 'select_one':
                $options = array();
                foreach ($fieldDetails['config']['options'] as $option) {
                    $options[$option['id']] = $option['label'];
                }
                echo "<div class='row'>" .
                TbHtml::activeLabel($formModel, '_' . $fieldDetails['id']) .
                TbHtml::activeDropDownList($formModel, '_' . $fieldDetails['id'], $options, array('prompt' => '--Please select--')) .
                TbHtml::error($formModel, '_' . $fieldDetails['id']) .
                "</div>";
                break;

            case 'hierarchy':
                $filteredData = Layer::search($fieldDetails['config']['hierarchy'], 'id', Yii::app()->user->getState('node_id'));
                if (!$filteredData) {
                    $data = Layer::parseHierarchy($fieldDetails['config']['hierarchy']);
                } else {
                    $data = Layer::parseHierarchy($filteredData);
                }
                echo "<div class='row tree-widget'>";

                echo TbHtml::activeLabel($formModel, '_' . $fieldDetails['id']);
                $this->widget('CTreeView', array(
                    'id' => '_' . $fieldDetails['id'],
                    'data' => $data,
                    'control' => '#treecontrol',
                    'animated' => 'fast',
                    'collapsed' => true,
                    'htmlOptions' => array(
                        'class' => 'treeview-gray',
                    )
                ));
                echo "<span class='hierarchy-field'>" . CHtml::activeHiddenField($formModel, '_' . $fieldDetails['id']) . "</span>";
                echo "</div>";
                break;
            case 'email':
                echo "<div class='row'>" .
                TbHtml::activeLabel($formModel, '_' . $fieldDetails['id']) .
                TbHtml::activeEmailField($formModel, '_' . $fieldDetails['id']) .
                TbHtml::error($formModel, '_' . $fieldDetails['id']) .
                "</div>";
                break;
            case 'date':

                echo "<div class='row'>";
                echo TbHtml::activeLabel($formModel, '_' . $fieldDetails['id']);
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model' => $formModel,
                    'attribute' => '_' . $fieldDetails['id'],
                    'options' => array(
                        'showAnim' => 'fold',
                        'showOn' => 'both', //focus,button,both
                        'changeMonth' => true,
                        'changeYear' => true,
                        'yearRange' => '-100:+0', //last hundred years
                        'buttonText' => 'Please select date',
                        'buttonImage' => Yii::app()->request->baseUrl . "/images/calendar.png",
                        'buttonImageOnly' => true,
                        'dateFormat' => 'dd/mm/yy',
                    ),
                    'htmlOptions' => array(
                        'style' => 'height:25px;',
                    ),
                ));
                echo TbHtml::error($formModel, '_' . $fieldDetails['id']);
                echo "</div>";
                break;
            case 'numeric':
                echo "<div class='row'>" .
                TbHtml::activeLabel($formModel, '_' . $fieldDetails['id']) .
                TbHtml::activeNumberField($formModel, '_' . $fieldDetails['id'], array('min' => 0)) .
                TbHtml::error($formModel, '_' . $fieldDetails['id']) .
                "</div>";
                break;

            default:
                /*
                 * FIXME: can be achieved by adding a field to a field mapping table to indicate whether it's readonly or not
                 */
                if ($fieldDetails['id'] == FieldMapping::CC_PRIMARY_SITE_CODE) {
                    echo "<div class='row'>" .
                    TbHtml::activeLabel($formModel, '_' . $fieldDetails['id']) .
                    TbHtml::activeTextField($formModel, '_' . $fieldDetails['id'], array('readonly' => true)) .
                    TbHtml::error($formModel, '_' . $fieldDetails['id']) .
                    "</div>";
                } else {
                    echo "<div class='row'>" .
                    TbHtml::activeLabel($formModel, '_' . $fieldDetails['id']) .
                    TbHtml::activeTextField($formModel, '_' . $fieldDetails['id']) .
                    TbHtml::error($formModel, '_' . $fieldDetails['id']) .
                    "</div>";
                }
        }
    }

    public function actionApprove($id) {
        $changeRequest = ChangeRequest::model()->findByPk($id);
        if ($changeRequest) {
            $version = $changeRequest->version_id;
            $requestType = $changeRequest->request_type;
            $siteID = $changeRequest->cc_site_id;
            $note = '';
            if (isset($_POST['ChangeRequestNote'])) {
                $note = $_POST['ChangeRequestNote']['note'];
            }

            $url = Yii::app()->params['api-domain'] . "/api/collections/" .
                    Yii::app()->params['resourceMapConfig']['curation_collection_id'] .
                    "/sites/{$siteID}/histories.json?version=$version";
            $response = RestUtility::execCurl($url);

            $responseArray = CJSON::decode($response, true);
            if ($requestType == ChangeRequest::TYPE_CREATE) {

                $properties = $this->sitePropertiesMapping($responseArray[0]['properties']);
                $data = array(
                    'name' => $responseArray[0]['name'],
                    'properties' => $properties
                );
                if (array_key_exists('lat', $responseArray[0]) && array_key_exists('lng', $responseArray[0])) {
                    $data['lat'] = $responseArray[0]['lat'];
                    $data['lng'] = $responseArray[0]['lng'];
                }

                $json = CJSON::encode($data);
                $params = array('site' => $json);
                $url = Yii::app()->params['api-domain'] . "/en/collections/" .
                        Yii::app()->params['resourceMapConfig']['public_collection_id'] .
                        "/sites.json";

                $response = RestUtility::execCurlPost($url, $params);
                $site = CJSON::decode($response, true);
                if (isset($site['id'])) {
                    $data_id = array(
                        'properties' => array(
                            '' . FieldMapping::CC_PRIMARY_SITE_CODE . '' => $site['properties'][FieldMapping::PC_PRIMARY_SITE_CODE]
                        )
                    );
                    $json = CJSON::encode($data_id);
                    $params = array('site' => $json);
                    $url = Yii::app()->params['api-domain'] . "/en/collections/" .
                            Yii::app()->params['resourceMapConfig']['curation_collection_id'] .
                            "/sites/{$changeRequest->cc_site_id}/partial_update";
                    $response = RestUtility::execCurlPost($url, $params);
                    $changeRequest->pc_site_id = $site['id'];
                    $changeRequest->status = ChangeRequest::STATUS_APPROVED;
                    $changeRequest->reviewed_by = Yii::app()->user->getState('user_id');
                    $changeRequest->reviewed_date = date('Y-m-d H:i:s');
                    $changeRequest->save();
                    $noteModel = new ChangeRequestNote();
                    $noteModel->change_request_id = $changeRequest->id;
                    $noteModel->user_id = Yii::app()->user->getState('user_id');
                    $noteModel->note = $note;

                    if ($noteModel->save()) {
                        $this->logAudit("Facility create request was approved given a Primary Site Code  " . $changeRequest->primary_site_code);
                        if ($data['properties']['13240'] == 1) {
                            $this->logDhisSiteCreate($changeRequest, $data);
                        }
                        echo TbHtml::alert(TbHtml::ALERT_COLOR_SUCCESS, 'Successfully created');
                    } else
                        echo TbHtml::alert(TbHtml::ALERT_COLOR_ERROR, 'Site creation failed');
                }
            }
            elseif ($requestType == ChangeRequest::TYPE_UPDATE) {
                //get changed fields from change_request_fields table
                $changedFields = ChangeRequestFields::model()->findAllByAttributes(
                        array(
                            'change_request_id' => $changeRequest->id,
                        )
                );
                //filter out non-updated fields
                $properties = array();
                foreach ($responseArray[0]['properties'] as $key => $property) {
                    foreach ($changedFields as $field) {
                        if ($key == $field->field_id) {
                            $properties[$key] = $property;
                        }
                    }
                }

                $properties = $this->sitePropertiesMapping($properties);
                $data = array();

                if (array_key_exists('name', $responseArray[0])) {
                    $data['name'] = $responseArray[0]['name'];
                }
                if (array_key_exists('lat', $responseArray[0]) && array_key_exists('lng', $responseArray[0])) {
                    $data['lat'] = $responseArray[0]['lat'];
                    $data['lng'] = $responseArray[0]['lng'];
                }
                if (!empty($properties)) {
                    $data['properties'] = $properties;
                }

                //encode the data into json format
                $json = CJSON::encode($data);
                $params = array('site' => $json);

                $result = $this->loadFacilityByPSC($changeRequest->primary_site_code, Yii::app()->params['resourceMapConfig']['public_collection_id']
                );
                $pc_site_id = $result['sites'][0]['id'];
                //update site in the public collection
                $url = Yii::app()->params['api-domain'] . "/en/collections/" .
                        Yii::app()->params['resourceMapConfig']['public_collection_id'] .
                        "/sites/{$pc_site_id}/partial_update";

                $response = RestUtility::execCurlPost($url, $params);
                //change status to approved and log info
                $site = CJSON::decode($response, true);
                if (isset($site['id'])) {
                    $changeRequest->pc_site_id = $site['id'];
                    $changeRequest->status = ChangeRequest::STATUS_APPROVED;
                    $changeRequest->reviewed_by = Yii::app()->user->getState('user_id');
                    $changeRequest->reviewed_date = date('Y-m-d H:i:s');
                    $changeRequest->save();
                    $noteModel = new ChangeRequestNote();
                    $noteModel->change_request_id = $changeRequest->id;
                    $noteModel->user_id = Yii::app()->user->getState('user_id');
                    $noteModel->note = $note;

                    if ($noteModel->save()) {
                        $this->logAudit("Facility update request was approved with Primary Site Code  " . $changeRequest->primary_site_code);
                        $this->logDhisSiteUpdate($changeRequest, $data);
                        echo TbHtml::alert(TbHtml::ALERT_COLOR_SUCCESS, 'Site update successful');
                    } else
                        echo TbHtml::alert(TbHtml::ALERT_COLOR_ERROR, 'Site update failed');
                }
            }
            elseif ($requestType == ChangeRequest::TYPE_DELETE) {
                //get hfr_uuid to use it when loging DHIS delete request
                $uuidSiteModel = Yii::app()->params['rm-fred-api-domain'] . "/collections/" .
                        Yii::app()->params['resourceMapConfig']['public_collection_id'] .
                        "/fred_api/v1/facilities.json?identifiers.id=" . $changeRequest->primary_site_code;
                $uuidSiteModelResponse = RestUtility::execCurl($uuidSiteModel);
                $uuidSiteModelResult = CJSON::decode($uuidSiteModelResponse, true);
                $hfr_uuid = $uuidSiteModelResult['facilities'][0]['uuid'];
                $hfr_site_id = $changeRequest->primary_site_code;
                $hfr_site_name = $uuidSiteModelResult['facilities'][0]['name'];

                //delete from public collection
                $url = Yii::app()->params['api-domain'] . "/en/collections/" .
                        Yii::app()->params['resourceMapConfig']['public_collection_id'] .
                        "/sites/{$changeRequest->pc_site_id}";
                RestUtility::execCurlDelete($url);

                //delete from curation collection
                $url = Yii::app()->params['api-domain'] . "/en/collections/" .
                        Yii::app()->params['resourceMapConfig']['curation_collection_id'] .
                        "/sites/{$changeRequest->cc_site_id}";
                RestUtility::execCurlDelete($url);

                $changeRequest->status = ChangeRequest::STATUS_APPROVED;
                $changeRequest->reviewed_by = Yii::app()->user->getState('user_id');
                $changeRequest->reviewed_date = date('Y-m-d H:i:s');
                $changeRequest->save();
                $noteModel = new ChangeRequestNote();
                $noteModel->change_request_id = $changeRequest->id;
                $noteModel->user_id = Yii::app()->user->getState('user_id');
                $noteModel->note = $note;
                if ($noteModel->save()) {
                    $this->logAudit("Facility delete request was approved with Primary Site Code  " . $changeRequest->primary_site_code);
                    $this->logDhisSiteDelete($id, $hfr_site_id, $hfr_site_name);
                    echo TbHtml::alert(TbHtml::ALERT_COLOR_SUCCESS, 'Successfully deleted');
                } else
                    echo TbHtml::alert(TbHtml::ALERT_COLOR_ERROR, 'Site could not be deleted');
            }
        }
    }

    public function actionReject($id) {
        $changeRequest = ChangeRequest::model()->findByPk($id);
        if ($changeRequest) {
            $requestType = $changeRequest->request_type;
            $note = '';
            if (isset($_POST['ChangeRequestNote'])) {
                $note = $_POST['ChangeRequestNote']['note'];
            }
            if ($requestType == ChangeRequest::TYPE_DELETE) {
                $changeRequest->status = ChangeRequest::STATUS_REJECTED;
                $changeRequest->reviewed_by = Yii::app()->user->getState('user_id');
                $changeRequest->reviewed_date = date('Y-m-d H:i:s');
                $changeRequest->save();
                $noteModel = new ChangeRequestNote();
                $noteModel->change_request_id = $changeRequest->id;
                $noteModel->user_id = Yii::app()->user->getState('user_id');
                $noteModel->note = $note;
                if ($noteModel->save()) {
                    $this->logAudit("Facility delete request was rejected with Primary Site Code  " . $changeRequest->primary_site_code);
                    echo TbHtml::alert(TbHtml::ALERT_COLOR_SUCCESS, 'Delete request rejected');
                } else
                    echo TbHtml::alert(TbHtml::ALERT_COLOR_ERROR, 'Rejection failed');
            }
            elseif ($requestType == ChangeRequest::TYPE_CREATE) {
                //delete from curation collection
                $url = Yii::app()->params['api-domain'] . "/en/collections/" .
                        Yii::app()->params['resourceMapConfig']['curation_collection_id'] .
                        "/sites/{$changeRequest->cc_site_id}";
                RestUtility::execCurlDelete($url);

                $changeRequest->status = ChangeRequest::STATUS_REJECTED;
                $changeRequest->reviewed_by = Yii::app()->user->getState('user_id');
                $changeRequest->reviewed_date = date('Y-m-d H:i:s');
                $changeRequest->save();
                $noteModel = new ChangeRequestNote();
                $noteModel->change_request_id = $changeRequest->id;
                $noteModel->user_id = Yii::app()->user->getState('user_id');
                $noteModel->note = $note;
                if ($noteModel->save()) {
                    $this->logAudit("Facility create request was rejected ");
                    echo TbHtml::alert(TbHtml::ALERT_COLOR_SUCCESS, 'Create request rejected');
                } else
                    echo TbHtml::alert(TbHtml::ALERT_COLOR_ERROR, 'Rejection failed');
            }
            elseif ($requestType == ChangeRequest::TYPE_UPDATE) {

                $url = Yii::app()->params['api-domain'] . "/api/collections/" .
                        Yii::app()->params['resourceMapConfig']['public_collection_id'] .
                        ".json?Fac_IDNumber={$changeRequest->primary_site_code}";



                $response = RestUtility::execCurl($url);
                $results = CJSON::decode($response, true);
                $site = $this->loadFacility($results['sites'][0]['id'], Yii::app()->params['resourceMapConfig']['public_collection_id']
                );

                if ($site) {

                    //get changed fields from change_request_fields table
                    $changedFields = ChangeRequestFields::model()->findAllByAttributes(
                            array(
                                'change_request_id' => $changeRequest->id,
                            )
                    );

                    //filter out non-updated fields
                    $properties = array();
                    foreach ($site['properties'] as $key => $property) {
                        foreach ($changedFields as $field) {
                            if ($key == $field->field_id) {
                                $properties[$key] = $property;
                            }
                        }
                    }

                    $data = array(
                        'properties' => $properties,
                    );

                    //encode the data into json format
                    $json = CJSON::encode($data);
                    $params = array('site' => $json);

                    //update site in the curation collection
                    $url = Yii::app()->params['api-domain'] . "/en/collections/" .
                            Yii::app()->params['resourceMapConfig']['curation_collection_id'] .
                            "/sites/{$changeRequest->cc_site_id}/partial_update";

                    $response = RestUtility::execCurlPost($url, $params);
                    $changeRequest->status = ChangeRequest::STATUS_REJECTED;
                    $changeRequest->reviewed_by = Yii::app()->user->getState('user_id');
                    $changeRequest->reviewed_date = date('Y-m-d H:i:s');
                    $changeRequest->save();
                    $noteModel = new ChangeRequestNote();
                    $noteModel->change_request_id = $changeRequest->id;
                    $noteModel->user_id = Yii::app()->user->getState('user_id');
                    $noteModel->note = $note;
                    if ($noteModel->save()) {
                        $this->logAudit("Facility update request was rejected with Primary Site Code  " . $changeRequest->primary_site_code);
                        echo TbHtml::alert(TbHtml::ALERT_COLOR_SUCCESS, 'Update request rejected');
                    } else
                        echo TbHtml::alert(TbHtml::ALERT_COLOR_ERROR, 'Rejection failed');
                }
                else {
                    echo TbHtml::alert(TbHtml::ALERT_COLOR_ERROR, 'Rejection failed');
                }
            }
        }
    }

    public function sitePropertiesMapping($siteProperties) {

        $fieldMappings = FieldMapping::model()->findAll();
        $properties = array();
        foreach ($fieldMappings as $fieldMapping) {
            foreach ($siteProperties as $key => $value) {
                if ($fieldMapping->cc_field_id == $key) {
//                                   if($key == FieldMapping::CC_PRIMARY_SITE_CODE){
//                                       continue;
//                                   }
                    $properties[$fieldMapping->pc_field_id] = $value;
                }
            }
        }
        return $properties;
    }

    //This was used to populate fields mapping table cache of field structures
    public function batchCache() {
        $fieldMappings = FieldMapping::model()->findAll();
        foreach ($fieldMappings as $fieldMapping) {
            $url = Yii::app()->params['api-domain'] . "/en/collections/" .
                    Yii::app()->params['resourceMapConfig']['public_collection_id'] .
                    "/fields/{$fieldMapping->pc_field_id}.json";

            $response = RestUtility::execCurl($url);
            $fieldMapping->pc_field_structure = $response;
            $fieldMapping->save();
        }
    }

    //Logging a DHIS Facility create request from HFR
    public function logDhisSiteCreate($hfrSiteModel, $data) {
        $uuidSiteModel = Yii::app()->params['rm-fred-api-domain'] . "/collections/" .
                Yii::app()->params['resourceMapConfig']['public_collection_id'] .
                "/fred_api/v1/facilities.json?identifiers.id=" . $hfrSiteModel->primary_site_code;

        $uuidSiteModelResponse = RestUtility::execCurl($uuidSiteModel);
        $uuidSiteModelResult = CJSON::decode($uuidSiteModelResponse, true);

        $properties = array();
        $properties['name'] = $data['name'];
//        $properties['openingdate'] = '1899-12-31';

        $hfr_identifier = array();
        $hfr_identifier['agency'] = 'DHIS2';
        $hfr_identifier['context'] = 'DHIS2_CODE';
        $hfr_identifier['id'] = $hfrSiteModel->primary_site_code;
        $properties['identifiers'] = [ $hfr_identifier];


        if (!empty($data['lng']) && !empty($data['lat'])) {
            $properties['coordinates'] = [$data['lng'], $data['lat']];
        }
        $properties['uuid'] = $uuidSiteModelResult['facilities'][0]['uuid'];

        $facility_properties = array();
        $council_node = substr($data['properties']['13164'], 0, 13);
        $council = HfrDhisMapping::model()->findByAttributes(array('hfr_id' => $council_node));
        $facility_properties['parent'] = $council->dhis_id;
        $properties['properties'] = $facility_properties;
        $json = CJSON::encode($properties);

        $message = "Dear Team,\r\n The Health Facility with the folleowing details have been created in DHIS from HFR:-\r\n Facility Name:-" . $data['name'] . "\r\n Facility ID:- " . $hfrSiteModel->primary_site_code . "\r\n Thanks,\r\n From HFR";

        $ownership = HfrDhisMapping::model()->findByAttributes(array('hfr_id' => $data['properties']['13238']));
        $type = HfrDhisMapping::model()->findByAttributes(array('hfr_id' => $data['properties']['13236']));


        $dhisSiteUrl = Yii::app()->params['dhis-api-domain'] . '/dhis/ohie/fred/v1/facilities.json';

        $response = RestUtility::execDhisCurlPost($dhisSiteUrl, $json);
        $results = CJSON::decode($response);


        if ($results) {
            if ($ownership) {
                $dhisSiteOwnershipDetailsUrl = Yii::app()->params['dhis-api-domain'] . '/dhis/api/organisationUnitGroups/' . $ownership->dhis_id . '/organisationUnits/' . $results['identifiers'][0]['id'];
                $ownershipDetailsResponse = RestUtility::execDhisOrgCurlPost($dhisSiteOwnershipDetailsUrl);

                $dhisSiteOwnershipGroupUrl = Yii::app()->params['dhis-api-domain'] . '/dhis/api/organisationUnitGroups/' . $ownership->parent_dhis_id . '/organisationUnits/' . $results['identifiers'][0]['id'];
                $ownershipDetailsResponse = RestUtility::execDhisOrgCurlPost($dhisSiteOwnershipGroupUrl);
            }
            if ($type) {
                $dhisSiteTypeUrl = Yii::app()->params['dhis-api-domain'] . '/dhis/api/organisationUnitGroups/' . $type->dhis_id . '/organisationUnits/' . $results['identifiers'][0]['id'];
                $typeResponse = RestUtility::execDhisOrgCurlPost($dhisSiteTypeUrl);
            }

            $subject = "New Health Facility Creation";
            $headers = 'From: HFR Team(hfr@moh.go.tz)' . "\r\n";
            mail(Yii::app()->params ['adminEmail'], $subject, $message, $headers);
        }
        return;
    }

    public function logDhisSiteUpdate($hfrSiteModel, $data) {
        $uuidSiteModel = Yii::app()->params['rm-fred-api-domain'] . "/collections/" .
                Yii::app()->params['resourceMapConfig']['public_collection_id'] .
                "/fred_api/v1/facilities.json?identifiers.id=" . $hfrSiteModel->primary_site_code;

        $uuidSiteModelResponse = RestUtility::execCurl($uuidSiteModel);
        $uuidSiteModelResult = CJSON::decode($uuidSiteModelResponse, true);

        $previousVersion = $hfrSiteModel->version_id - 1;
        $previousSiteID = $hfrSiteModel->cc_site_id;
        $url = Yii::app()->params['api-domain'] . "/api/collections/" .
                Yii::app()->params['resourceMapConfig']['curation_collection_id'] .
                "/sites/{$previousSiteID}/histories.json?version=$previousVersion";
        $previousVersionResponse = RestUtility::execCurl($url);
        $previousVesrionResults = CJSON::decode($previousVersionResponse);
        $priviousOperatingStatus = $previousVesrionResults[0]['properties'][13304];
        $priviousHierarchy = $previousVesrionResults[0]['properties'][13274];
        $priviousOwnership = $previousVesrionResults[0]['properties'][13302];
        $priviousType = $previousVesrionResults[0]['properties'][13300];

        if (($data['properties']['13240'] && $data['properties']['13240'] == 1) || ($priviousOperatingStatus == 1)) {
            if ($data['properties']['13238']) {
                $ownership = HfrDhisMapping::model()->findByAttributes(array('hfr_id' => $data['properties']['13238']));
            } else {
                $ownership = HfrDhisMapping::model()->findByAttributes(array('hfr_id' => $priviousOwnership));
            }
            if ($data['properties']['13236']) {
                $type = HfrDhisMapping::model()->findByAttributes(array('hfr_id' => $data['properties']['13236']));
            } else {
                $type = HfrDhisMapping::model()->findByAttributes(array('hfr_id' => $priviousType));
            }

            $properties = array();
            $properties['name'] = $data['name'];
//            $properties['openingdate'] = '1899-12-31';

            $hfr_identifier = array();
            $hfr_identifier['agency'] = 'DHIS2';
            $hfr_identifier['context'] = 'DHIS2_CODE';
            $hfr_identifier['id'] = $hfrSiteModel->primary_site_code;
            $properties['identifiers'] = [ $hfr_identifier];


            if (!empty($data['lng']) && !empty($data['lat'])) {
                $properties['coordinates'] = [$data['lng'], $data['lat']];
            }
            $properties['uuid'] = $uuidSiteModelResult['facilities'][0]['uuid'];

            if ($data['properties']['13164']) {
                $facility_properties = array();
                $council_node = substr($data['properties']['13164'], 0, 13);
                $council = HfrDhisMapping::model()->findByAttributes(array('hfr_id' => $council_node));
                $facility_properties['parent'] = $council->dhis_id;
                $properties['properties'] = $facility_properties;
            } else {
                $facility_properties = array();
                $council_node = substr($priviousHierarchy, 0, 13);
                $council = HfrDhisMapping::model()->findByAttributes(array('hfr_id' => $council_node));
                $facility_properties['parent'] = $council->dhis_id;
                $properties['properties'] = $facility_properties;
            }

            $json = CJSON::encode($properties);

            if ($priviousOperatingStatus == 1) {
                $dhisSiteUrl = Yii::app()->params['dhis-api-domain'] . '/dhis/ohie/fred/v1/facilities/' . $uuidSiteModelResult['facilities'][0]['uuid'];
                $response = RestUtility::execDhisCurlPut($dhisSiteUrl, $json);
            } else {
                $dhisSiteUrl = Yii::app()->params['dhis-api-domain'] . '/dhis/ohie/fred/v1/facilities.json';
                $response = RestUtility::execDhisCurlPost($dhisSiteUrl, $json);
                $message = "Dear Team,\r\n The Health Facility with the folleowing details have been created in DHIS from HFR:-\r\n Facility Name:-" . $data['name'] . "\r\n Facility ID:- " . $hfrSiteModel->primary_site_code . "\r\n Thanks,\r\n From HFR";
                $subject = "New Health Facility Creation";
                $headers = 'From: HFR Team(hfr@moh.go.tz)' . "\r\n";
                mail(Yii::app()->params ['adminEmail'], $subject, $message, $headers);
            }

            if ($data['properties']['13240'] == 1 && $priviousOperatingStatus == 1) {
                $message = "Dear Team,\r\n The Health Facility with the following details have been created in DHIS from HFR \r\n Facility Name:-" . $data['name'] . "\r\n Facility ID:- " . $hfrSiteModel->primary_site_code . "\r\n Thanks,\r\n From HFR";
                $subject = "Operating Status change of a Health Facility in HFR";
                $headers = 'From: HFR Team(hfr@moh.go.tz)' . "\r\n";
                mail(Yii::app()->params['adminEmail'], $subject, $message, $headers);
            }
            $results = CJSON::decode($response);
            if ($results) {
                if ($ownership) {
                    if ($priviousOperatingStatus == 1) {
                        $dhisOwnershipGroupUrl = Yii::app()->params['dhis-api-domain'] . '/dhis/api/organisationUnits/' . $results['identifiers'][0]['id'];
                        $dhisOwnershipGroupResponse = RestUtility::execDhisCurl($dhisOwnershipGroupUrl);
                        $dhisOwnershipGroupResult = CJSON::decode($dhisOwnershipGroupResponse);
                        $ownershipOrganisationUnitGroups = $dhisOwnershipGroupResult['organisationUnitGroups'];
                        foreach ($ownershipOrganisationUnitGroups as $ownershipOrganisationUnitGroup) {
                            $facility_ownerships = HfrDhisMapping::model()->findAllByAttributes(array('type' => 3));
                            foreach ($facility_ownerships as $facility_ownership) {
                                if (strcmp($ownershipOrganisationUnitGroup['id'], $facility_ownership->dhis_id) == 0) {
                                    $dhisDeleteOwnershipUrl = Yii::app()->params['dhis-api-domain'] . '/dhis/api/organisationUnitGroups/' . $facility_ownership->dhis_id . '/organisationUnits/' . $results['identifiers'][0]['id'];
                                    $previousOwnershipResponse = RestUtility::execDhisOrgCurlDelete($dhisDeleteOwnershipUrl);
                                    $dhisDeleteOwnershipGroupUrl = Yii::app()->params['dhis-api-domain'] . '/dhis/api/organisationUnitGroups/' . $facility_ownership->parent_dhis_id . '/organisationUnits/' . $results['identifiers'][0]['id'];
                                    $previousOwnershipGroupResponse = RestUtility::execDhisOrgCurlDelete($dhisDeleteOwnershipGroupUrl);
                                }
                            }
                        }
                    }
                    $dhisSiteOwnershipDetailsUrl = Yii::app()->params['dhis-api-domain'] . '/dhis/api/organisationUnitGroups/' . $ownership->dhis_id . '/organisationUnits/' . $results['identifiers'][0]['id'];
                    $ownershipDetailsResponse = RestUtility::execDhisOrgCurlPost($dhisSiteOwnershipDetailsUrl);

                    $dhisSiteOwnershipGroupUrl = Yii::app()->params['dhis-api-domain'] . '/dhis/api/organisationUnitGroups/' . $ownership->parent_dhis_id . '/organisationUnits/' . $results['identifiers'][0]['id'];
                    $ownershipDetailsResponse = RestUtility::execDhisOrgCurlPost($dhisSiteOwnershipGroupUrl);
                }
                if ($type) {
                    if ($priviousOperatingStatus == 1) {
                        $dhisTypeGroupUrl = Yii::app()->params['dhis-api-domain'] . '/dhis/api/organisationUnits/' . $results['identifiers'][0]['id'];
                        $dhisTypeGroupResponse = RestUtility::execDhisCurl($dhisTypeGroupUrl);
                        $dhisTypeGroupResult = CJSON::decode($dhisTypeGroupResponse);
                        $typeOrganisationUnitGroups = $dhisTypeGroupResult['organisationUnitGroups'];
                        foreach ($typeOrganisationUnitGroups as $typeOrganisationUnitGroup) {
                            $facility_types = HfrDhisMapping::model()->findAllByAttributes(array('type' => 2));
                            foreach ($facility_types as $facility_type) {
                                if (strcmp($typeOrganisationUnitGroup['id'], $facility_type->dhis_id) == 0) {
                                    $dhisDeleteTypeUrl = Yii::app()->params['dhis-api-domain'] . '/dhis/api/organisationUnitGroups/' . $facility_type->dhis_id . '/organisationUnits/' . $results['identifiers'][0]['id'];
                                    $previousTypeResponse = RestUtility::execDhisOrgCurlDelete($dhisDeleteTypeUrl);
                                }
                            }
                        }
                    }
                    $dhisSiteTypeUrl = Yii::app()->params['dhis-api-domain'] . '/dhis/api/organisationUnitGroups/' . $type->dhis_id . '/organisationUnits/' . $results['identifiers'][0]['id'];
                    $typeResponse = RestUtility::execDhisOrgCurlPost($dhisSiteTypeUrl);
                }

                if ($priviousOperatingStatus == 1) {
                    if ($data['properties'] ['13240']) {
                        if ($data['properties']['13240'] == 2) {
                            $message = "Dear Team,\r\n The Health Facility with the following details  has been changed to Pending Operation - Under  Construction Status in HFR \r\n Facility Name:-" . $data['name'] . " \r\n Facility ID:- " . $hfrSiteModel->primary_site_code . " \r\n Thanks,\r\n From HFR";
                        } elseif ($data['properties']['13240'] == 3) {
                            $message = "Dear Team,\r\n The Health Facility with the following details  has been changed to Pending Operation - Construction Complete Status in HFR \r\n Facility Name:-" . $data['name'] . " \r\n Facility ID:- " . $hfrSiteModel->primary_site_code . " \r\n Thanks,\r\n From HFR";
                        } elseif ($data['properties']['13240'] == 4) {
                            $message = "Dear Team,\r\n The Health Facility with the following details  has been changed to Closed (Temporary) Status in HFR \r\n Facility Name:-" . $data['name'] . " \r\n Facility ID:- " . $hfrSiteModel->primary_site_code . " \r\n Thanks,\r\n From HFR";
                        } elseif ($data['properties']['13240'] == 5) {
                            $message = "Dear Team,\r\n The Health Facility with the following details  has been changed to Closed Status in HFR \r\n Facility Name:-" . $data['name'] . " \r\n Facility ID:- " . $hfrSiteModel->primary_site_code . " \r\n Thanks,\r\n From HFR";
                        }
                        $subject = "Operating Status change of a Health Facility in HFR";
                        $headers = 'From: HFR Team(hfr@moh.go.tz)' . "\r\n";
                        mail(Yii::app()->params['adminEmail'], $subject, $message, $headers);
                    }
                }
            }
        }
        return;
    }

    public function logDhisSiteDelete($id, $hfr_site_id, $hfr_site_name) {
        $note = ChangeRequestNote::model()->findByAttributes(array('change_request_id' => $id));
        $message = "Dear Team,\r\n The Health Facility with the following details   has been deleted in HFR \r\n Facility Name:-" . $hfr_site_name . " \r\n Facility ID:- " . $hfr_site_id . " \r\n Reason for Deletion being:- " . $note->note . " \r\n Thanks,\r\n From HFR Team";
        $subject = "Deletion of Health Facility in HFR";
        $headers = 'From:HFR Team(hfr@moh.go.tz)' . "\r\n";
        mail(Yii::app()->params['adminEmail'], $subject, $message, $headers);
        return;
    }

    //Loads all Deleted Facilities in Tanzania
    public function actionDeletedFacilities() {
        $url = Yii::app()->params['api-domain'] . "/api/collections/" .
                Yii::app()->params['resourceMapConfig']['public_collection_id'] .
                ".json?page=all&Admin_div[under]=TZ&deleted_since==2012-01-01&human=true";

        $response = RestUtility::execCurl($url);
        $result = CJSON::decode($response, true);

        $totalItemCount = (int) $result['count'];
        $totalPages = (int) $result['totalPages'] == 0 ? 1 : (int) $result['totalPages'];
        $pageSize = ceil($totalItemCount / $totalPages);

        Yii::app()->user->setFlash('sites_count', $totalItemCount . ' Deleted Health Facilities were found'
        );

        $sites = new CArrayDataProvider($result['sites'], array(
            'totalItemCount' => $totalItemCount,
            'pagination' => array(
                'pageSize' => 50
            )
                )
        );

        $this->render('_deletedFacilitiesGrid', array('sites' => $sites, 'url' => $url));
    }

    //Export Multiple Facilities Detais into Excel
    public function actionExportToExcel($url) {
        $response = RestUtility::execCurl($url);
        $result = CJSON::decode($response, true);
        $this->renderPartial('_exportToExcelTemp', array('sites' => $result['sites']));
    }

}
