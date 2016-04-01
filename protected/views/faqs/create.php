<?php
/* @var $this FaqsController */
/* @var $model Faqs */
?>

<?php
    echo TbHtml::pageHeader('','Add New Frequently Asked Questions....');
?>
<div class="well">
    
<?php $this->renderPartial('_form', array('model'=>$model)); ?>

</div>