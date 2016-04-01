<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>


<script language="javascript">
    
    
    function showProgress(){
        $("#progress-div").html('<?php echo TbHtml::animatedProgressBar(100); ?>');
        return;
    }
 
</script>

<?php echo TbHtml::pageHeader('','Login'); ?>
<div id="progress-div">
    
</div>
   
<div class="well">
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<div class="row">
		<?php //echo $form->labelEx($model,'username'); ?>
		<?php //echo $form->textField($model,'username'); ?>
		<?php //echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'password'); ?>
		<?php //echo $form->passwordField($model,'password'); ?>
		<?php //echo $form->error($model,'password'); ?>
		<p class="hint"> 
                    <?php //echo TbHtml::link("Can't access your account ".TbHtml::icon(TbHtml::ICON_QUESTION_SIGN),'#')?>
		</p>
	</div>

	<div class="row rememberMe">
		<?php //echo $form->checkBox($model,'rememberMe'); ?>
		<?php //echo $form->label($model,'rememberMe'); ?>
		<?php //echo $form->error($model,'rememberMe'); ?>
	</div>

	<div class="row buttons">
		<?php //echo CHtml::submitButton('Login',array('class'=>'btn btn-info','id'=>'btn-login','onclick'=>'showProgress()')); ?>
                <?php echo TbHtml::link('Login',
                        $this->createUrl('site/openid',array('login'=>true)),array('class'=>'btn btn-info'))
                        ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
    
</div><!-- well -->