<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<?php echo TbHtml::pageHeader('', 'View/Change Facility');?>
<div class="well">
      <?php if(Yii::app()->user->hasFlash('success')):?>
        <div class="alert alert-success">
              <?php echo Yii::app()->user->getFlash('success');?>
        </div>
    <?php endif;?>
    <?php
    $this->widget('bootstrap.widgets.TbDetailView', array(
        'type'=>  TbHtml::DETAIL_TYPE_BORDERED,
        'data' => $model,
        'attributes' => array(
        
            array(
                'label'=>'ID',
                'value'=>$model['id'],
            ),
            array(
                'label' => 'Name',
                'value' => $model['name'],
            ),
           // 'organization_id',
            array(
                'label' => 'PSC',
                'value' =>isset($model["properties"]["1697"])?$model["properties"]["1697"]:"Not set"
            ),
           array(
                'label'=>'Node ID',
                'value'=>isset($model["properties"]["2512"])?$model["properties"]["2512"]:"Not set"
            ),
            array(
                'label' => 'Ownership',
                'value'=>isset($model["properties"]["1709"])?$model["properties"]["1709"]:"Not set"
            ),
        ),
    ));

?>
    
</div>