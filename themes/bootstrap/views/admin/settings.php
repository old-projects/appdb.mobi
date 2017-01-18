<?php
$this->pageTitle = 'Настройки сайта';
$this->breadcrumbs = array(
	'Настройки сайта',
);
$this->layout = 'main';
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
		'id' => 'horizontalForm',
		'type' => 'horizontal',
	)); ?>
	<fieldset>
		<legend>Настройки сайта</legend>

		<?php echo $form->textAreaRow($model, 'siteClosedMessage', array('class' => 'span8', 'rows' => 5)); ?>

	</fieldset>
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'type' => 'danger', 'label' => ($model->siteClosed ? 'Изменить сообщение' : 'Закрыть сайт'), 'htmlOptions' => array('name' => 'close'))); ?>
		<?php if ($model->siteClosed) $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'type' => 'primary', 'label' => 'Открыть сайт', 'htmlOptions' => array('name' => 'open'))); ?>
	</div>

<?php $this->endWidget(); ?>
