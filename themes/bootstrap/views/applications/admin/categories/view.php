<?php
$this->breadcrumbs = array(
	$this->module->adminLinkTitle => array($this->module->adminLink),
	'Категории' => $this->createUrl('admin'),
	$model->name,
);

$this->menu = array(
	array('label' => 'Вернуться к списку', 'url' => array('admin'), 'icon' => 'list'),
	array('label' => 'Изменить', 'url' => array('update', 'id' => $model->id), 'icon' => 'pencil'),
	array('label' => 'Удалить', 'url' => array('delete', 'id' => $model->id), 'icon' => 'trash'),
);
?>

<h1>Просмотр категории #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data' => $model,
	'attributes' => array(
		'id',
		'root',
		'lft',
		'rgt',
		'level',
		'name',
		'latin_name',
		'description',
	),
)); ?>
