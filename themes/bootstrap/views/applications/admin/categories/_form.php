<?php
$params = array();
if (isset($parent))
	$params['parent'] = $parent->id;
else
	$params['id'] = $model->id;
?>
<div class="form">
<fieldset>
	<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action' => Yii::app()->createUrl($this->route, $params),
	'type' => 'horizontal',
	'id' => 'applications-categories-android-form',
	'enableAjaxValidation' => true,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model, 'name', array('size' => 60, 'maxlength' => 100, 'autofocus' => 'autofocus')); ?>
	<?php echo $form->textFieldRow($model, 'latin_name', array('size' => 60, 'maxlength' => 100)); ?>
	<?php echo $form->textAreaRow($model, 'description', array('rows' => 6, 'cols' => 50)); ?>


	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'label' => $model->isNewRecord ? 'Создать' : 'Обновить')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
