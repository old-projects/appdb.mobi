<div class="form">
<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id' => 'applications-form',
	'type' => 'horizontal',
	'enableAjaxValidation' => true,
)); ?>

<fieldset>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model, 'fourpda_topic_id', array('size' => 10, 'maxlength' => 10)); ?>

	<?php echo $form->textFieldRow($model, 'name', array('size' => 60, 'maxlength' => 200)); ?>

	<?php echo $form->textFieldRow($model, 'latin_name', array('size' => 60, 'maxlength' => 200)); ?>

	<?php echo $form->textAreaRow($model, 'short_description', array('rows' => 6, 'cols' => 50)); ?>

	<?php echo $form->textAreaRow($model, 'long_description', array('rows' => 6, 'cols' => 50)); ?>

	<?php echo $form->textFieldRow($model, 'latest_version', array('size' => 60, 'maxlength' => 100)); ?>

	<?php echo $form->dropDownListRow($model, 'platform', array(
		'android' => 'Android',
		'ios' => 'iOS',
		'wp' => 'Windows Phone',
		'symbian' => 'Symbian',
		'j2me' => 'J2ME',
		)); ?>

	<?php echo $form->dropDownListRow($model, 'type', array('game' => 'Игра', 'program' => 'Программа')); ?>

	</fieldset>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'type'=>'primary', 'label' => $model->isNewRecord ? 'Создать' : 'Обновить')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->