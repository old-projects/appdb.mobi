<?php
$this->breadcrumbs = array(
	$this->module->adminLinkTitle,
);
$this->layout = '//layouts/main';
?>

<div class="row-fluid">
	<div class="span4">
		<h3>Категории</h3>
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'label' => 'Всего: '.$total_categories,
			'type' => 'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
			'size' => 'large', // null, 'large', 'small' or 'mini'
			'url' => $this->createUrl('admin/categories'),
		)); ?>
	</div>
	<div class="span4">
		<h3>Приложения</h3>
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'label' => 'Всего: '.$total_applications,
			'type' => 'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
			'size' => 'large', // null, 'large', 'small' or 'mini'
			'url' => $this->createUrl('admin/applications'),
		)); ?>
	</div>
	<div class="span4">
		<h3>Платформы</h3>
		<?php
		$platforms_menu = array();
		foreach ($platforms as $platform_id => $platform_data) {
			$platforms_menu[$platform_id] = array(
				'label' => $platform_data['label'],
				'url' => $this->createUrl('', array('platform' => $platform_id)),
			);
		}
		?>
		<?php $this->widget('bootstrap.widgets.TbMenu', array(
			'type' => 'tabs', // '', 'tabs', 'pills' (or 'list')
			'stacked' => true, // whether this is a stacked menu
			'items' => $platforms_menu,
		)); ?>
	</div>
</div>

<div class="row-fluid">
	<div class="span6">
		<h3>Приложения по платформе</h3>
		<?php $this->widget('bootstrap.widgets.TbGridView', array(
			'type' => 'bordered',
			'dataProvider' => $platforms_provider,
			'template' => "{items}\n{pager}",
			));
		?>
	</div>
	<div class="span6">
		<h3>Приложения по типу</h3>
		<?php $this->widget('bootstrap.widgets.TbGridView', array(
			'type' => 'bordered',
			'dataProvider' => $types_provider,
			'template' => "{items}\n{pager}",
			));
		?>
	</div>
</div>

