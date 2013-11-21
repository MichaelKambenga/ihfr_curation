<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<?php echo TbHtml::pageHeader('', 'Explore Facilities')?>

<div class="well" style="float: left;width:100%; clear: both; padding: 0" >
   
    <div id="left-panel" style="width: 22%;clear: left;float: left; min-height: 300px;height: 600px;overflow-y: scroll">
        <h3 class="btn-info">&nbsp;</h3>
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
    <?php echo TbHtml::searchQueryField('search','',array('id'=>'search_text_field','placeholder'=>'Search by public site code')); ?>
    <?php echo TbHtml::ajaxButton('Search',$this->createUrl('SearchFacilityByPSCode'),
                      array(
                                'type'=>'GET',
                                'data'=>array('search_query'=>'js: $("#search_text_field").val()'),
                                'update'=>'#facilityGrid'
                           )
            )
    ?>
    <?php echo TbHtml::endForm(); ?>

   
    <?php echo TbHtml::link('Create facility',$this->createUrl('createSite'), array('class'=>'btn btn-info')) ?>
    <br /><br />
    <div id="gridContainer">
       <?php $this->renderPartial('_facilityGrid',array('sites'=>$sites));?>
    </div>
    
    </div>
    
</div>

<script type="text/javascript">
/*<![CDATA[*/

jQuery(document).on('click','ul#menu-treeview a',function() {
	
	var th = this,
		afterAjaxUpdate = function(){};
	jQuery('#facilityGrid').yiiGridView('update', {
		type: 'GET',
		url: jQuery(this).attr('href'),
		success: function(data) {
                        $('#gridContainer').html(data);
		
		},
		error: function(XHR) {
			return afterAjaxUpdate('#facilityGrid', data,XHR);
		}
	});
	return false;
});

/*]]>*/
</script>

