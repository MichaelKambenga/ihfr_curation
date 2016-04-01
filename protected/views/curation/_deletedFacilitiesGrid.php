<div class="well">
    <?php
    ?>
    <div class="alert alert-success">
        <?php echo Yii::app()->user->getFlash('sites_count'); ?>
    </div>

    <div style="float: right">
        <?php
        echo TbHtml::pills(array(
            array('label' => 'Excel Export', 'url' => $this->createUrl("exportToExcel", array("url" => $url)),),
        ));
        ?>
    </div>
    <?php
    $this->widget('bootstrap.widgets.TbGridView', array(
        'id' => 'facilityGrid',
        'type' => TbHtml::GRID_TYPE_BORDERED,
        'dataProvider' => $sites,
//    'filter' => $sites,
//    'template' => "{items}",
        'columns' => array(
            array(
                'header' => 'S/N',
                'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
            ),
            array(
                'name' => 'psc',
                'header' => 'Facility_ID',
                'value' => 'isset($data["properties"]["Fac_IDNumber"])?$data["properties"]["Fac_IDNumber"]:"Not set"'
            ),
            array(
                'name' => 'name',
                'header' => 'Registered Name',
                'htmlOptions' => array('width' => '180px'),
            ),
//            array(
//                'name' => 'Comm_FacName',
//                'header' => 'Common Name',
//                'value' => 'isset($data["properties"]["Comm_FacName"])?$data["properties"]["Comm_FacName"]:$data["name"]'
//            ),
            array(
                'name' => 'Type',
                'header' => 'Type',
                'value' => 'isset($data["properties"]["Fac_Type"])?$data["properties"]["Fac_Type"]:"Not set"',
                'htmlOptions' => array('width' => '100px'),
            ),
            array(
                'name' => 'ownership',
                'header' => 'Ownership',
                'value' => 'isset($data["properties"]["Ownership"])?$data["properties"]["Ownership"]:"Not set"',
                'htmlOptions' => array('width' => '100px'),
            ),
            array(
                'header' => 'Region',
                'value' => 'AdminHierarchy::model()->getRegion($data["properties"]["Admin_div"])',
            ),
            array(
                'header' => 'Coucil',
                'value' => 'AdminHierarchy::model()->getCouncil($data["properties"]["Admin_div"])',
            ),
            array(
                'header' => 'When Deleted',
                'value' => 'isset($data["deletedAt"])?substr($data["deletedAt"],0,10):"Not set"',
                 'htmlOptions' => array('width' => '100px'),
            ),
            array(
                'header' => 'Reason',
                'value' => 'ChangeRequestNote::model()->getReason($data["properties"]["Fac_IDNumber"])',
                'htmlOptions' => array('width' => '200px'),
            ),
        ),
    ));
    ?>

</div>

