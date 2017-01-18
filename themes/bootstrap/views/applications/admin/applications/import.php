<?php
$this->pageTitle = 'Импорт с 4pda';
$this->layout = '//layouts/main';
$this->breadcrumbs = array(
	$this->module->adminLinkTitle => array($this->module->adminLink),
	'Управление приложениями' => $this->createUrl('admin'),
	'Импорт с 4pda',
);

// $this->menu = array(
// 	array('label' => 'Вернуться к списку', 'url' => array('admin'), 'icon' => 'list'),
// 	array('label' => 'Получение содержимого поста', 'url' => array('parse'), 'icon' => 'list'),
// );
?>

<div class="row-fluid">
	<div class="span12">

		<?php $this->widget('bootstrap.widgets.TbAlert', array(
				'block' => true, // display a larger alert block?
				'fade' => true, // use transitions?
				'closeText' => '&times;', // close link text - if set to false, no close link is displayed
				'alerts' => array( // configurations per alert type
						'success' => array('block' => true, 'fade' => true, 'closeText' => '&times;'), // success, info, warning, error or danger
				),
		)); ?>

		<?php
		$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
				'id' => 'importForm',
				'type' => 'horizontal',
		)); ?>
		<fieldset>
			<legend><?= CHtml::encode($this->pageTitle) ?></legend>

			<?php echo $form->dropDownListRow($model, 'category_id', $model->categoriesForDropdownList, array('size' => 10)); ?>
			<?php echo $form->dropDownListRow($model, 'platform', array(
				'android' => 'Android',
				'ios' => 'iOS',
				'wp' => 'Windows Phone',
				'symbian' => 'Symbian',
				'j2me' => 'J2ME',
				)); ?>

			<?php echo $form->dropDownListRow($model, 'type', array('game' => 'Игра', 'program' => 'Программа')); ?>
			<?php echo $form->textAreaRow($model, 'text', array('class' => 'span12', 'rows' => 30, 'style' => 'font-family: monospace;')); ?>
			<?php echo $form->dropDownListRow($model, 'parser', array('android_programs' => 'Android программы', 'android_games' => 'Android игры', 'j2me' => 'J2ME', 'symbian_programs' => 'Symbian программы', 'symbian_games' => 'Symbian игры')); ?>
		</fieldset>

		<div class="form-actions">
			<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'label' => 'Парсить', 'htmlOptions' => array('name' => 'parse'))); ?>
		</div>


		<?php if (!empty($model->dataProvider)): ?>
		<?php $this->widget('bootstrap.widgets.TbGridView', array(
			'type' => 'bordered',
			'dataProvider' => $model->dataProvider,
			'template' => "{summary}\n{items}",
			'columns' => array(
				'actions' => array(
					'class' => 'application.components.DataColumn',
					'value' => '$form->dropDownListRow($model, "actions[".($data["4pda_id"])."]", $data["actions"]); ?>',
					'value' => '!empty($data["actions"]) ? CHtml::activeDropDownList($model, "actions[".($data["4pda_id"])."]", $data["actions"]) : null',
					// 'value' => 'CHtml::dropdownList("")',
					'data' => array('form' => $form, 'model' => $model),
					'type' => 'raw',
				),
				'4pda_id',
				'name' => array(
					'value' => '!empty($data["id"]) ? CHtml::link(CHtml::encode($data["name"]), Yii::app()->createUrl(Yii::app()->controller->uniqueId."/view", array("id" => $data["id"])), array("target" => "_blank")) : CHtml::encode($data["name"])',
					'type' => 'raw',
				),
				'version',
				'description',
				'flags',
				'status' => array(
					'value' => 'CHtml::tag("span", array(
						"class" => "badge ".($data["status"] == ImportForm::OK ? "badge-success"
							: ($data["status"] == ImportForm::ANOTHER_CATEGORY ? "badge-warning" : "badge-important"))
						), $data["status"] == ImportForm::OK ? "OK"
							: ($data["status"] == ImportForm::ANOTHER_CATEGORY ? "Another category" : "Missing"))',
					'type' => 'raw',
				),
			),
			));
		?>
		<div class="form-actions">
			<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'type' => 'primary', 'label' => 'Импорт', 'disabled' => empty($model->dataProvider), 'htmlOptions' => array('name' => 'import'))); ?>
		</div>
		<?php endif; ?>
		<?php $this->endWidget(); ?>
	</div>
</div>
