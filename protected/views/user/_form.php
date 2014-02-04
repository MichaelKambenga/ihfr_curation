<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'user-form',
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'email'); ?>
        <?php echo $form->textField($model, 'email', array('size' => 45, 'maxlength' => 45)); ?>
        <?php echo $form->error($model, 'email'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'firstname'); ?>
        <?php echo $form->textField($model, 'firstname', array('size' => 45, 'maxlength' => 45)); ?>
        <?php echo $form->error($model, 'firstname'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'lastname'); ?>
        <?php echo $form->textField($model, 'lastname', array('size' => 45, 'maxlength' => 45)); ?>
        <?php echo $form->error($model, 'lastname'); ?>
    </div>

    <div class="row">
        <?php echo $form->hiddenField($model, 'node_id', array('size' => 45, 'maxlength' => 45)); ?>
        <?php echo $form->error($model, 'node_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'position_id'); ?>
        <?php echo $form->dropDownList($model, 'position_id', CHtml::listData(Position::model()->findAll(), 'id', 'position_name'), array('empty' => '--Select Position--')); ?>
        <?php echo $form->error($model, 'position_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'organization_id'); ?>
        <?php echo $form->dropDownList($model, 'organization_id', CHtml::listData(Organization::model()->findAll(), 'id', 'organization_name'), array('empty' => '--Select Organization--')); ?>
        <?php echo $form->error($model, 'organization_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'phone_number'); ?>
        <?php echo $form->textField($model, 'phone_number', array('size' => 45, 'maxlength' => 45)); ?>
        <?php echo $form->error($model, 'phone_number'); ?>
    </div>
    
    <div class="row">
        <?php echo $form->labelEx($model, 'admin_hierarchy'); ?>
        <?php echo $form->dropDownList($model, 'admin_hierarchy', array(1=>'Central',2=>'Zonal',3=>'Regional',4=>'District'),
                 array(
                        'prompt'=>'--Please select',
                        'onchange'=>'toggleDisplay(this.value)',
                        )
                
                );
        ?>
        <?php echo $form->error($model, 'admin_hierarchy'); ?>
    </div>
    
    <div class="row" id="zone_div">
       
    <?php 
        $data = array();
        $options = Layer::getAreaOptions();
        foreach($options['zones'] as $option){
            $data[$option['id']] = $option['name'];
        }
        echo TbHtml::label('Zone', 'zone');
        echo TbHtml::dropDownListControlGroup('zone', '', $data,
                array(
                        'prompt'=>'--Please select',
                        'ajax'=>array(
                            'type'=>'GET',
                            'url'=>CController::createUrl('user/GetLowerAdminHierarchy'),
                            'update'=>'#region',
                            'data'=>array('nodeId'=>'js:this.value')
                        ),
                        )
                );
    ?>
                       
    </div>
    <div class="row" id="region_div">
       
    <?php 
        $data = array();
        $options = Layer::getAreaOptions();
        foreach($options['regions'] as $option){
            $data[$option['id']] = $option['name'];
        }
        echo TbHtml::label('Region','region');
        echo TbHtml::dropDownListControlGroup('region', '', $data,
                array(
                        'prompt'=>'--Please select',
                        'ajax'=>array(
                            'type'=>'GET',
                            'url'=>CController::createUrl('user/GetLowerAdminHierarchy'),
                            'update'=>'#district',
                            'data'=>array('nodeId'=>'js:this.value')
                        ),
                        )
                );
    ?>
                       
    </div>
    
    <div class="row" id="district_div">
       
    <?php 
        $data = array();
        $options = Layer::getAreaOptions();
        foreach($options['districts'] as $option){
            $data[$option['id']] = $option['name'];
        }
        echo TbHtml::label('District', 'district');
        echo TbHtml::dropDownListControlGroup('district', '',$data,array('prompt'=>'--Please select--'));
    ?>
                       
    </div>
    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn btn-info', 'id'=>'btn-submit')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
<?php
    $this->widget('bootstrap.widgets.TbModal', array(
        'id' => 'update-modal-dialog',
        'header' => 'Confirm profile update',
        'content' => '<p>
           Are you sure you want to update user information? 
        </p>',
        'footer' => array(
            TbHtml::button('Cancel', array('data-dismiss' => 'modal')),
            TbHtml::button('OK', array('data-dismiss' => 'modal','onclick'=>'js:processSubmission();' ,'color' => TbHtml::BUTTON_COLOR_PRIMARY)),
            
        ),
    ));
   ?>
<script type="text/javascript">
    function toggleDisplay(value){
        if(value==1){
            $("#zone_div").hide();
            $("#region_div").hide();
            $("#district_div").hide();
        }else if(value == 2){ 
            $("#zone_div").show();
            $("#region_div").hide();
            $("#district_div").hide();
        }else if(value == 3){
            $("#zone_div").show();
            $("#region_div").show();
            $("#district_div").hide();
        }else if(value == 4){
            $("#zone_div").show();
            $("#region_div").show();
            $("#district_div").show();
        }
    }
    
    function processSubmission(){
        var value = $("#User_admin_hierarchy").val();
        if(value==1){
            $("#User_node_id").val("TZ");
        }else if(value == 2){ 
            $("#User_node_id").val($("#zone").val());
        }else if(value == 3){
            $("#User_node_id").val($("#region").val());
        }else if(value == 4){
            $("#User_node_id").val($("#district").val());
        }
        
        $("#user-form").submit();
        return true;
    }
    
    $("#btn-submit").click(function(){
        $("#update-modal-dialog").modal();
        return false;
    });
    
    
</script>


    