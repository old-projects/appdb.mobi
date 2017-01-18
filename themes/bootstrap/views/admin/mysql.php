<?php
$this->breadcrumbs = array(
	'MySQL-запрос',
);
$this->layout = 'main';
$this->pageTitle = 'MySQL';
?>

<div class="row-fluid">
	<div class="span12">

	<?php $this->widget('bootstrap.widgets.TbAlert', array(
		'block' => true, // display a larger alert block?
		'fade' => true, // use transitions?
		'closeText' => '&times;', // close link text - if set to false, no close link is displayed
		'alerts' => array( // configurations per alert type
			'success' => array('block' => true, 'fade' => true, 'closeText' => '&times;'), // success, info, warning, error or danger
			'error' => array('block' => true, 'fade' => true, 'closeText' => '&times;'), // success, info, warning, error or danger
		),
	)); ?>

	<?php
	$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id' => 'horizontalForm',
		'type' => 'horizontal',
	)); ?>
	<fieldset>
		<legend>MySQL-запрос</legend>

		<?php echo $form->textAreaRow($model, 'query', array('class' => 'span8', 'rows' => 5, 'style' => 'font-family: monospace;')); ?>
		<?php echo $form->checkBoxRow($model, 'select'); ?>

	</fieldset>
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'type' => 'primary', 'label' => 'Выполнить')); ?>
	</div>

	<?php $this->endWidget(); ?>

<?php if (!empty($dataProvider)): ?>
	<?php $this->widget('bootstrap.widgets.TbGridView', array(
		'type' => 'striped bordered condensed',
		'dataProvider' => $dataProvider,
		'columns' => isset($keys) ? $keys : array(),
	)); ?>
<?php endif; ?>
