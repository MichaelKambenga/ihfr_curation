<?php if($model->request_type == ChangeRequest::TYPE_CREATE):?>
<?php 
     $url = Yii::app()->params['api-domain']."/collections/".
                   Yii::app()->params['resourceMapConfig']['curation_collection_id'].
                   "/sites/".$model->cc_site_id.".json"; 
            $response = RestUtility::execCurl($url);
            $site = CJSON::decode($response,true);

?>
<?php $fields = ChangeRequest::getFieldValues($site['properties'],Yii::app()->params['resourceMapConfig']['curation_collection_id'])?>

<table>
<?php foreach($fields as $key=>$field):?>
    
<?php if(!is_array($field)):?>
<tr>
    <td><?php echo TbHtml::labelTb($key, array('color' => TbHtml::LABEL_COLOR_INFO))?></td>
    <?php //echo TbHtml::labelTb($field, array('color' => TbHtml::LABEL_COLOR_INFO)); ?>
    <?php //echo TbHtml::icon(TbHtml::ICON_ARROW_RIGHT) ?>
    <td><?php echo TbHtml::labelTb($field); ?></td>
</tr>

<?php else:?>
<tr>
    <td><?php echo TbHtml::labelTb($key, array('color' => TbHtml::LABEL_COLOR_INFO))?></td>
    <?php //echo TbHtml::labelTb($field, array('color' => TbHtml::LABEL_COLOR_INFO)); ?>
    <?php //echo TbHtml::icon(TbHtml::ICON_ARROW_RIGHT) ?>
    <?php $concatValues = "";?>
    <?php foreach($field as $value):?>
           <?php $concatValues.= $value.'<br />';?>
    <?php endforeach;?>
    <td><?php echo TbHtml::labelTb($concatValues); ?></td>
</tr>
   
      
<?php endif;?>

<?php endforeach;?>
<tr >
<td></td>
<td>
    <?php echo TbHtml::button('Reject', array(
                'class'=>'btn btn-default',
                'onclick'=>'$("'.'#reject-dialog'.$model->id.'").dialog("open");return false;',
               )
    )?>
    <span>&nbsp;&nbsp;</span>

    <?php echo TbHtml::button('Approve', array(
                'class'=>'btn btn-info',
                'onclick'=>'$("'.'#approve-dialog'.$model->id.'").dialog("open");return false;',
               )
    )?>
</td>
</tr>
</table>
<br />

<?php 
      $this->beginWidget('zii.widgets.jui.CJuiDialog',array(
            'id'=>'reject-dialog'.$model->id,
                    // additional javascript options for the dialog plugin
                    'options'=>array(
                        'title'=>'Reject Request',
                        'autoOpen'=>false,
                        'height'=>300,
                        'width'=>400,
                    ),
                   
                    
                ));
            
      $this->renderPartial('//changeRequestNote/_form',array('model'=>new ChangeRequestNote,'actionType'=>'reject','id'=>$model->id));

      $this->endWidget('zii.widgets.jui.CJuiDialog');
?>

<?php 
      $this->beginWidget('zii.widgets.jui.CJuiDialog',array(
            'id'=>'approve-dialog'.$model->id,
                    // additional javascript options for the dialog plugin
                    'options'=>array(
                        'title'=>'Approve Request',
                        'autoOpen'=>false,
                        'height'=>300,
                        'width'=>400,
                    ),
                   
                    
                ));
            
      $this->renderPartial('//changeRequestNote/_form',array('model'=>new ChangeRequestNote,'actionType'=>'approve','id'=>$model->id));

      $this->endWidget('zii.widgets.jui.CJuiDialog');
?>

<?php elseif($model->request_type == ChangeRequest::TYPE_UPDATE):?>
<?php 
      $changedFields = ChangeRequestFields::model()->findAllByAttributes(
              array(
                  'change_request_id'=>$model->id
              )
      );
      
       $url = Yii::app()->params['api-domain']."/api/collections/".
                         Yii::app()->params['resourceMapConfig']['curation_collection_id'].
                         "/sites/{$model->cc_site_id}/histories.json?version=$model->version_id";
       $response = RestUtility::execCurl($url);
       $responseArray = CJSON::decode($response, true);
       $proposedProperties = $responseArray[0]['properties'];
       
       $newFields = array();
       foreach($proposedProperties as $key=>$property){
           foreach($changedFields as $changedField){
               if($changedField->field_id == $key){
                   $newFields[$key]=$property;
               }
           }
       }
       
       $fields = ChangeRequest::getFieldValues($newFields,Yii::app()->params['resourceMapConfig']['curation_collection_id']);
      
       $results = $this->loadFacilityByPSC($model->primary_site_code,Yii::app()->params['resourceMapConfig']['public_collection_id']);
       $pc_site_id = $results['sites'][0]['id'];
       $site = $this->loadFacility($pc_site_id, 
                     Yii::app()->params['resourceMapConfig']['public_collection_id']
                    ); 
       $siteProperties = $site['properties'];
       $pubFields = array();
       foreach($siteProperties as $key=>$property){
           foreach($changedFields as $changedField){
               $fieldMapping = FieldMapping::model()->findByAttributes(array('cc_field_id'=>$changedField->field_id));
               if($fieldMapping->pc_field_id == $key){
                   $pubFields[$key]=$property;
               }
           }
       }    
            
       $publicFields = ChangeRequest::getFieldValues($pubFields,Yii::app()->params['resourceMapConfig']['public_collection_id']);
      
       
 ?>
<table>
    <tr>
        <td>Current values</td><td></td>
    </tr>
<?php foreach($publicFields as $key=>$field):?>
    
<?php if(!is_array($field)):?>
<tr>
    <td><?php echo TbHtml::labelTb($key, array('color' => TbHtml::LABEL_COLOR_INFO))?></td>
    <?php //echo TbHtml::labelTb($field, array('color' => TbHtml::LABEL_COLOR_INFO)); ?>
    <?php //echo TbHtml::icon(TbHtml::ICON_ARROW_RIGHT) ?>
    <td><?php echo TbHtml::labelTb($field); ?></td>
</tr>

<?php else:?>
<tr>
    <td><?php echo TbHtml::labelTb($key, array('color' => TbHtml::LABEL_COLOR_INFO))?></td>
    <?php //echo TbHtml::labelTb($field, array('color' => TbHtml::LABEL_COLOR_INFO)); ?>
    <?php //echo TbHtml::icon(TbHtml::ICON_ARROW_RIGHT) ?>
    <?php $concatValues = "";?>
    <?php foreach($field as $k=>$value):?>
           <?php $concatValues.= $value.'<br />';?>
    <?php endforeach;?>
    <td><?php echo TbHtml::labelTb($concatValues); ?></td>
</tr>
   
      
<?php endif;?>

<?php endforeach;?>
</table>
<p></p><p></p>

<table>
    <tr>
        <td>Changes made</td><td></td>
    </tr>
<?php foreach($fields as $key=>$field):?>
    
<?php if(!is_array($field)):?>
<tr>
    <td><?php echo TbHtml::labelTb($key, array('color' => TbHtml::LABEL_COLOR_INFO))?></td>
    <?php //echo TbHtml::labelTb($field, array('color' => TbHtml::LABEL_COLOR_INFO)); ?>
    <?php //echo TbHtml::icon(TbHtml::ICON_ARROW_RIGHT) ?>
    <td><?php echo TbHtml::labelTb($field); ?></td>
</tr>

<?php else:?>
<tr>
    <td><?php echo TbHtml::labelTb($key, array('color' => TbHtml::LABEL_COLOR_INFO))?></td>
    <?php //echo TbHtml::labelTb($field, array('color' => TbHtml::LABEL_COLOR_INFO)); ?>
    <?php //echo TbHtml::icon(TbHtml::ICON_ARROW_RIGHT) ?>
    <?php $concatValues = "";?>
    <?php foreach($field as $k=>$value):?>
           <?php $concatValues.= $value.'<br />';?>
    <?php endforeach;?>
    <td><?php echo TbHtml::labelTb($concatValues); ?></td>
</tr>
   
      
<?php endif;?>

<?php endforeach;?>
<tr >
<td></td>
<td>
    <?php echo TbHtml::button('Reject', array(
                'class'=>'btn btn-default',
                'onclick'=>'$("'.'#reject-dialog'.$model->id.'").dialog("open");return false;',
               )
    )?>
    <span>&nbsp;&nbsp;</span>

    <?php echo TbHtml::button('Approve', array(
                'class'=>'btn btn-info',
                'onclick'=>'$("'.'#approve-dialog'.$model->id.'").dialog("open");return false;',
               )
    )?>
</td>
</tr>
</table>
<br />

<?php 
      $this->beginWidget('zii.widgets.jui.CJuiDialog',array(
            'id'=>'reject-dialog'.$model->id,
                    // additional javascript options for the dialog plugin
                    'options'=>array(
                        'title'=>'Reject Request',
                        'autoOpen'=>false,
                        'height'=>300,
                        'width'=>400,
                    ),
                   
                    
                ));
            
      $this->renderPartial('//changeRequestNote/_form',array('model'=>new ChangeRequestNote,'actionType'=>'reject','id'=>$model->id));

      $this->endWidget('zii.widgets.jui.CJuiDialog');
?>

<?php 
      $this->beginWidget('zii.widgets.jui.CJuiDialog',array(
            'id'=>'approve-dialog'.$model->id,
                    // additional javascript options for the dialog plugin
                    'options'=>array(
                        'title'=>'Approve Request',
                        'autoOpen'=>false,
                        'height'=>300,
                        'width'=>400,
                    ),
                   
                    
                ));
            
      $this->renderPartial('//changeRequestNote/_form',array('model'=>new ChangeRequestNote,'actionType'=>'approve','id'=>$model->id));

      $this->endWidget('zii.widgets.jui.CJuiDialog');
?>

<?php elseif($model->request_type == ChangeRequest::TYPE_DELETE):?>

<?php endif;?>