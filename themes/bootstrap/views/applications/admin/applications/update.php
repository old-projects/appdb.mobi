<?php
$this->pageTitle = 'Изменение приложения '.$model->name;
$this->breadcrumbs = array(
	$this->module->adminLinkTitle => array($this->module->adminLink),
	'Управление приложениями' => $this->createUrl('admin'),
	$model->name => array('view', 'id' => $model->id),
	'Изменение',
);

$this->menu = array(
	array('label' => 'Вернуться к списку', 'url' => array('admin'), 'icon' => 'list'),
	array('label' => 'Просмотреть', 'url' => array('view', 'id' => $model->id), 'icon' => 'pencil'),
	array('label' => 'Удалить', 'url' => array('delete', 'id' => $model->id), 'icon' => 'trash'),
);
?>

<legend><?= CHtml::encode($this->pageTitle) ?></legend>

<?php $this->renderPartial('_form', array('model' => $model)); ?>