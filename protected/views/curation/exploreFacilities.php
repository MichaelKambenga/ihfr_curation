<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<?php echo TbHtml::pageHeader('', 'Explore Facilities')?>

<div class="well" style="float: left;width:100%; clear: both; padding: 0" >
    
    <div id="left-panel" style="width: 22%;clear: left;float: left; min-height: 300px;height: 600px;overflow-y: scroll">
        <?php 
            echo TbHtml::button('',
            array('block' => true, 
            'color' => TbHtml::BUTTON_COLOR_DEFAULT, 
            'size'=>TbHtml::BUTTON_SIZE_LARGE)); 
        ?>
       <?php $this->widget('CTreeView',array(
             'id'=>'menu-treeview',
             'data'=>$data,
             'control'=>'#treecontrol',
             'animated'=>'fast',
             'collapsed'=>true,
             'htmlOptions'=>array(
                'class'=>'treeview-gray',
               
   )
       ) );
       
       ?>
    </div>
    <div id="right-panel" style="padding: 1%;padding-left: 2%;width: 68%;clear:right;float:left;min-height: 300px; border-left: 1px solid #D9DEE4;">
        <?php echo TbHtml::beginFormTb(TbHtml::FORM_LAYOUT_SEARCH); ?>
    <?php echo TbHtml::searchQueryField('search'); ?>
    <?php echo TbHtml::submitButton('Search'); ?>
    <?php echo TbHtml::endForm(); ?>
    
    <?php echo TbHtml::button('Create facility', array('class'=>'btn-primary')) ?>
    <br /><br />
    <?php $this->widget('bootstrap.widgets.TbGridView', array(
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
    'value'=>'isset($data["properties"]["1697"])?$data["properties"]["1697"]:"Not set"'
    ),
//    array(
//    'name' => 'location',
//    'header' => 'Location',
//    ),
//    
    array(
        'name'=>'nodeID',
        'header'=>'Node ID',
        'value'=>'isset($data["properties"]["2512"])?$data["properties"]["2512"]:"Not set"'
    ),
    array(
    'name' => 'ownership',
    'header' => 'Ownership',
    'value'=>'isset($data["properties"]["1709"])?$data["properties"]["1709"]:"Not set"'
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
    )); ?>
    </div>
    
</div>
