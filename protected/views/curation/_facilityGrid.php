<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id'=>'facilityGrid',
    'type'=>  TbHtml::GRID_TYPE_BORDERED,
    'dataProvider' => $sites,
//    'filter' => $person,
//    'template' => "{items}",
    'columns' => array(
    array(
    'name' => 'id',
    'header' => '#',
    'htmlOptions' => array('color' =>'width: 60px'),
    ),
    array(
    'name' => 'name',
    'header' => 'Name',
    ),
    array(
    'name' => 'psc',
    'header' => 'PSC',
    'value'=>'isset($data["properties"]["Fac_IDNumber"])?$data["properties"]["Fac_IDNumber"]:"Not set"'
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
        'template'=>'{view}{update}{delete}',
        'buttons'=>array(
            'delete'=>array('url'=>'#'),
            'update'=>array('url'=>'#'),
            'view'=>array(
                'url'=>'$this->grid->controller->createUrl("curation/viewFacility",array("id"=>$data["id"]))',
                ),
        ),
    ),
    ),
    )); 
?>
