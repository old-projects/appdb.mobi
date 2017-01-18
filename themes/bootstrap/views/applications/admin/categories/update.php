<?php
$this->pageTitle = 'Изменение папки '.$model->name;
$this->breadcrumbs = array(
	$this->module->adminLinkTitle => array($this->module->adminLink),
	'Категории' => $this->createUrl('admin'),
	$model->name => array('view', 'id' => $model->id),
	'Изменение',
);

$this->menu = array(
	array('label' => 'Вернуться к списку', 'url' => array('admin'), 'icon' => 'list'),
);
?>

<legend><?= CHtml::encode($this->pageTitle) ?></legend>

<?php $this->renderPartial('_form', array('model' => $model)); ?>