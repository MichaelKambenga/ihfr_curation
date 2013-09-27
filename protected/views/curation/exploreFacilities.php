<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<?php echo TbHtml::pageHeader('', 'Explore Facilities')?>

<div class="well" style="float: left;width:100%; clear: both; padding: 0" >
    
    <div id="left-panel" style="width: 20%;clear: left;float: left; min-height: 300px;height: 600px;overflow-y: scroll">
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
    <div id="right-panel" style="padding: 1%;padding-left: 2%;width: 70%;clear:right;float:left;min-height: 300px; border-left: 1px solid #D9DEE4;">
        <?php echo TbHtml::beginFormTb(TbHtml::FORM_LAYOUT_SEARCH); ?>
    <?php echo TbHtml::searchQueryField('search'); ?>
    <?php echo TbHtml::submitButton('Search'); ?>
    <?php echo TbHtml::endForm(); ?>
    <?php 
       $persons = new CArrayDataProvider(
               array(
                   array(
                       'id'=>'1',
                       'name'=>'Robert',
                       'psc'=>'1-234-46859',
                       'location'=>'Dar es salaam',
                       'ownership'=>'Government',
                       'type'=>'Referral Hospital'
                   ),
                   
                   array(
                       'id'=>'1',
                       'name'=>'Robert',
                       'psc'=>'1-234-46859',
                       'location'=>'Dar es salaam',
                       'ownership'=>'Government',
                       'type'=>'Referral Hospital'
                   ),
                   
                   array(
                       'id'=>'1',
                       'name'=>'Robert',
                       'psc'=>'1-234-46859',
                       'location'=>'Dar es salaam',
                       'ownership'=>'Government',
                       'type'=>'Referral Hospital'
                   ),
                   array(
                       'id'=>'1',
                       'name'=>'Robert',
                       'psc'=>'1-234-46859',
                       'location'=>'Dar es salaam',
                       'ownership'=>'Government',
                       'type'=>'Referral Hospital'
                   ),
                   
                     array(
                       'id'=>'1',
                       'name'=>'Robert',
                       'psc'=>'1-234-46859',
                       'location'=>'Dar es salaam',
                       'ownership'=>'Government',
                       'type'=>'Referral Hospital'
                   ),
                   
                   array(
                       'id'=>'1',
                       'name'=>'Robert',
                       'psc'=>'1-234-46859',
                       'location'=>'Dar es salaam',
                       'ownership'=>'Government',
                       'type'=>'Referral Hospital'
                   ),
                   array(
                       'id'=>'1',
                       'name'=>'Robert',
                       'psc'=>'1-234-46859',
                       'location'=>'Dar es salaam',
                       'ownership'=>'Government',
                       'type'=>'Referral Hospital'
                   ),
                   
                     array(
                       'id'=>'1',
                       'name'=>'Robert',
                       'psc'=>'1-234-46859',
                       'location'=>'Dar es salaam',
                       'ownership'=>'Government',
                       'type'=>'Referral Hospital'
                   ),
                   
                   array(
                       'id'=>'1',
                       'name'=>'Robert',
                       'psc'=>'1-234-46859',
                       'location'=>'Dar es salaam',
                       'ownership'=>'Government',
                       'type'=>'Referral Hospital'
                   ),
                   array(
                       'id'=>'1',
                       'name'=>'Robert',
                       'psc'=>'1-234-46859',
                       'location'=>'Dar es salaam',
                       'ownership'=>'Government',
                       'type'=>'Referral Hospital'
                   ),
               )
               
               );
    ?>
    
    <?php echo TbHtml::button('Create facility', array('class'=>'btn-primary')) ?>
    <br /><br />
    <?php $this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>  TbHtml::GRID_TYPE_BORDERED,
    'dataProvider' => $persons,
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
    ),
    array(
    'name' => 'location',
    'header' => 'Location',
    ),
    array(
    'name' => 'ownership',
    'header' => 'Ownership',
    ),
    array(
    'name' => 'type',
    'header' => 'Type',
    ),
    array(
        'class'=>'bootstrap.widgets.TbButtonColumn',
        'template'=>'{view}{update}{delete}',
        'buttons'=>array(
            'delete'=>array('url'=>'#'),
            'update'=>array('url'=>'#'),
            'view'=>array('url'=>'#'),
        ),
    ),
    ),
    )); ?>
    </div>
    
</div>
