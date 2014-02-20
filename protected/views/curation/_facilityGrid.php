<?php ?>

<script type="text/javascript">
    var trashButton ='link';
    
    function deleteFacility(){
      $.get(trashButton,function(data,status){
         //alert(data);
         $("#delete-model-message .modal-body p").html(data);
         $("#delete-model-message").modal();
      });
   }
</script>

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id'=>'facilityGrid',
    'type'=>  TbHtml::GRID_TYPE_STRIPED,
    'dataProvider' => $sites,
//    'filter' => $person,
//    'template' => "{items}",
    'columns' => array(
//    array(
//    'name' => 'id',
//    'header' => '#',
//    'htmlOptions' => array('color' =>'width: 60px'),
//    ),
    array(
    'name' => 'psc',
    'header' => 'Primary Site Code',
    'value'=>'isset($data["properties"]["Fac_IDNumber"])?$data["properties"]["Fac_IDNumber"]:"Not set"'
    ),
    array(
    'name' => 'name',
    'header' => 'Name',
    ),
//    
//    array(
//        'name'=>'nodeID',
//        'header'=>'Node ID',
//        'value'=>'isset($data["properties"]["Admin_div"])?$data["properties"]["Admin_div"]:"Not set"'
//    ),
    array(
        'name'=>'Facility Type',
        'header'=>'Facility Type',
        'value'=>'isset($data["properties"]["Fac_Type"])?$data["properties"]["Fac_Type"]:"Not set"'
    ),
    array(
    'name' => 'ownership',
    'header' => 'Ownership',
    'value'=>'isset($data["properties"]["Ownership"])?$data["properties"]["Ownership"]:"Not set"'
    ),
    array(
        'class'=>'bootstrap.widgets.TbButtonColumn',
        'template'=>'{update}{remove}',
        'buttons'=>array(
            'remove'=>array(
                'label'=>'',
                'url'=>'$this->grid->controller->createUrl("curation/deleteSite",array("psc"=>$data["properties"]["Fac_IDNumber"],"pc_id"=>$data["id"]))',
                'options'=>array(
                    'class'=>  TbHtml::ICON_TRASH,
                    'title'=>'Delete',
                 ),
                'click'=>'js:function(){
                           $("#delete-model-dialog").modal();
                           trashButton = this;
                           return false;
                      }'
                ),
            
            'update'=>array('url'=>'$this->grid->controller->createUrl("curation/updateSite",array("id"=>$data["properties"]["Fac_IDNumber"]))'),
//            'view'=>array(
//                'url'=>'$this->grid->controller->createUrl("curation/view",array("id"=>$data["id"]))',
//                ),
        ),
    ),
    ),
    )); 
?>

 <?php
    $this->widget('bootstrap.widgets.TbModal', array(
        'id' => 'delete-model-dialog',
        'header' => 'Confirm delete',
        'content' => '<p>
           Are you sure you want to request deletion of this health facility?  
           Note that if a facility has closed down, 
           its operational status should be changed and it should not be deleted.  
           Deletion should only be for cases of facility duplication or mistaken facility records
           representing a facility which never existed. 
        </p>',
        'footer' => array(
            TbHtml::button('Cancel', array('data-dismiss' => 'modal')),
            TbHtml::button('OK', array('data-dismiss' => 'modal','onclick'=>'js:deleteFacility();' ,'color' => TbHtml::BUTTON_COLOR_PRIMARY)),
            
        ),
    ));
   ?>

<?php
    $this->widget('bootstrap.widgets.TbModal', array(
        'id' => 'delete-model-message',
        'header' => 'Alert',
        'content' => '<p></p>',
        'footer' => array(
            TbHtml::button('Close', array('data-dismiss' => 'modal')),
        ),
    ));
   ?>
