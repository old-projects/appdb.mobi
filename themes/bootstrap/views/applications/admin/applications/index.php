<?php
/* @var $this ApplicationsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Application',
);

$this->menu=array(
	array('label'=>'Create Application', 'url'=>array('create')),
	array('label'=>'Manage Application', 'url'=>array('admin')),
);
?>

<h1>Application</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
