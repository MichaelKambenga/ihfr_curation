<?php
$this->breadcrumbs=array(
	'Groups',
);
?>

<h1>Auth Items</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
