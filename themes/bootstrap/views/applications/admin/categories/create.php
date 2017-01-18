<?php
$this->pageTitle = 'Создание новой';
if (isset($parent))
	$this->pageTitle .= ' в папке '.$parent->name;
$this->breadcrumbs = array(
	$this->module->adminLinkTitle => array($this->module->adminLink),
	'Категории' => $this->createUrl('admin'),
	'Новая папка',
);

$this->menu = array(
	array('label' => 'Вернуться к списку', 'url' => array('admin'), 'icon' => 'list'),
);
?>

<legend><?= CHtml::encode($this->pageTitle) ?></legend>

<?php $this->renderPartial('_form', array('model' => $model, 'parent' => isset($parent) ? $parent : null)); ?>