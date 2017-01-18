<?php
$this->breadcrumbs = array(
	$this->module->adminLinkTitle => array($this->module->adminLink),
	'Управление приложениями',
);

$this->menu = array(
	array('label' => 'Добавить приложение', 'url' => array('create'), 'icon' => 'plus'),
	array('label' => 'Импорт с 4pda', 'url' => array('import'), 'icon' => 'plus'),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#applications-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Управление приложениями</h1>

<?php echo CHtml::link('Расширенный поиск', '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model' => $model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id' => 'applications-grid',
	'type'=>'striped bordered condensed',
	'dataProvider' => $model->search(),
	'filter' => $model,
	'columns' => array(
		'id',
		'fourpda_topic_id',
		'name',
		'latin_name',
		'short_description',
		/*
		'long_description',
		'latest_version',
		'status',
		'add_time',
		'update_time',
		'platform',
		'type',
		*/
		array(
			'class' => 'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
