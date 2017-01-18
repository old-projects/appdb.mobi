<?php
$this->pageTitle = 'Добавление приложения';
$this->breadcrumbs = array(
	$this->module->adminLinkTitle => array($this->module->adminLink),
	'Управление приложениями' => $this->createUrl('admin'),
	'Новое приложение',
);

$this->menu = array(
	array('label' => 'Вернуться к списку', 'url' => array('admin'), 'icon' => 'list'),
);
?>

<legend><?= CHtml::encode($this->pageTitle) ?></legend>

<?php $this->renderPartial('_form', array('model' => $model)); ?>