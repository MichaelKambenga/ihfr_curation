<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id'=>'facilityGrid',
    'type'=>  TbHtml::GRID_TYPE_BORDERED,
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
    
//    array(
//    'name' => 'location',
//    'header' => 'Location',
//    ),
//    
    array(
        'name'=>'nodeID',
        'header'=>'Node ID',
        'value'=>'isset($data["properties"]["Admin_div"])?$data["properties"]["Admin_div"]:"Not set"'
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
                    'data-toggle'=>'#modal',
                    'data-target'=>'#myModal'
                 ),
                'click'=>'js:function(){
                    var flag = confirm("Are you sure you want to request deletion of this health facility?  Note that if a facility has closed down, its operational status should be changed and it should not be deleted.  Deletion should only be for cases of facility duplication or mistaken facility records representing a facility which never existed.");
                    if(flag==true){
                      $.get(this,function(data,status){
                         alert(data);
                      });
                    }
                    else{
                      return false;
                    }
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
