<div class="wide form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
                'action' => Yii::app()->createUrl($this->route),
                'method' => 'get',
            ));
    ?>

    <div class="row">
<?php echo $form->label($model, 'userId', array('id' => 'label')); ?>
<?php echo $form->textField($model, 'userId'); ?>
    </div>
    <div class="row">
<?php echo $form->label($model, 'action', array('id' => 'label')); ?>
<?php echo $form->textField($model, 'action'); ?>
    </div>
    <div class="row">
        <?php echo $form->label($model, 'Activity Date', array('id' => 'label')); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'model' => $model,
            'attribute' => 'date',
            // additional javascript options for the date picker plugin
            'options' => array(
                'showAnim' => 'fold',
                'dateFormat' => 'yy-mm-dd',
                'changeYear' => true,
                'changeMonth' => true
            ),
            'htmlOptions' => array(
                'style' => 'height:20px;',
            ),
        ));
        ?>
    </div>



    <div class="row buttons">
<?php echo CHtml::submitButton('Search'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->