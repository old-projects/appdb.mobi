<?php
$this->pageTitle = 'Приложение '.$model->name;

$this->breadcrumbs = array(
	$this->module->adminLinkTitle => array($this->module->adminLink),
	'Управление приложениями' => $this->createUrl('admin'),
	$model->name,
);

$this->menu = array(
	array('label' => 'Вернуться к списку', 'url' => array('admin'), 'icon' => 'list'),
	array('label' => 'Изменить', 'url' => array('update', 'id' => $model->id), 'icon' => 'pencil'),
	array('label' => 'Удалить', 'url' => array('delete', 'id' => $model->id), 'icon' => 'trash'),
);
?>

<h1><?= CHtml::encode($this->pageTitle) ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data' => $model,
	// 'attributes' => array(
		// 'id',
		// 'category' => array(
		// 	'name' => 'category',
		// 	'value' => $model->category->name,
		// ),
		// // 'fourpda_topic_id',
		// 'name',
		// 'latin_name',
		// 'short_description',
		// 'long_description',
		// 'latest_version',
		// 'status',
		// 'add_time',
		// 'update_time',
		// 'platform',
		// 'type',
	// ),
)); ?>
