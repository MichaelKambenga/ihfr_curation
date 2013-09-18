<?php
$this->breadcrumbs=array(
	'Groups'=>array('index'),
	$model->name,
);
?>

<h1>View Group/Role:-<?php echo $model->name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'name',
		//'type',
		'description',
		//'bizrule',
		//'data',
	),
)); 

echo '<div class="submenu">';
echo CHtml::link('[Back]|', $this->createUrl('authItem/admin'));
echo CHtml::link('[Add Privileges To The Group]', $this->createUrl('/authItem/assignItems',array('name' => $model->name)));
//echo CHtml::link('[Add Privileges To The Group]', $this->createUrl('/group/assignItems',array('id' => $model->id,'groupname' => $model->name,'description' => $model->description )));
echo "</div>";
?>
