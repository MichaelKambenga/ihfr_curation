<?php
/* @var $this FaqsController */
/* @var $model Faqs */
?>

<?php
    echo TbHtml::pageHeader('','Update Frequently Asked Questions....'.$model->id);
?>
<div class="well">
    
<?php $this->renderPartial('_form', array('model'=>$model)); ?>
    
</div>