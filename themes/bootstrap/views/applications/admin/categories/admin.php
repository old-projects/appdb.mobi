<?php
$this->breadcrumbs = array(
	$this->module->adminLinkTitle => array($this->module->adminLink),
	'Категории',
);

$this->menu = array(
	array('label' => 'Добавить папку', 'url' => array('create'), 'icon' => 'plus'),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#categories-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Папки</h1>

<?php echo CHtml::link('Расширенный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model' => $model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('ext.QTreeGridView.CQTreeGridViewBootstrap', array(
	'id' => 'categories-grid',
	'type' => 'striped bordered condensed',
	'dataProvider' => $model->search(),
	'ajaxUpdate' => false,
	'filter' => $model,
	'columns' => array(
		'id',
		'name',
		'latin_name',
		// 'description',
		array(
			'class' => 'bootstrap.widgets.TbButtonColumn',
			'template' => '{draggable} {addChild} <!--{view}--> {update} <!--{ajaxdelete}--> {delete}',
			'buttons' => array(
				'draggable' => array(
					'label' => 'Переместить',
					'icon' => 'move',
					'url'   => '',
					'options' => array('class' => 'draggable-handle'),
				),
				'ajaxdelete' => array(
					'icon' => 'remove',
					'link' => '#myModal',
					'options' => array(
						'data-toggle' => 'modal',
						'data-target' => '#myModal',
					),
				),
				'addChild' => array(
					'icon' => 'plus',
					'url' => 'Yii::app()->createUrl(Yii::app()->controller->uniqueId."/create", array("parent" => $data->id))',
					'options' => array(
						'title' => 'Создать подкаталог',
					),
				),
			),
		),
	),
)); ?>

<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id' => 'myModal')); ?>

<div class="modal-header">
	<a class="close" data-dismiss="modal">&times;</a>
	<h4>Удаление папки</h4>
</div>

<div class="modal-body">
	<p>Действительно удалить папку "<?= 12 ?>"?</p>
</div>

<div class="modal-footer">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
		'type' => 'danger',
		'label' => 'Да, УДАЛИТЬ!!!11',
		'url' => '#',
		'htmlOptions' => array('data-dismiss' => 'modal'),
	)); ?>
	<?php $this->widget('bootstrap.widgets.TbButton', array(
		'label' => 'Нет',
		'url' => '#',
		'htmlOptions' => array('data-dismiss' => 'modal'),
	)); ?>
</div>

<?php $this->endWidget(); ?>
