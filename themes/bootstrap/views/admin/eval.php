<?php
$this->breadcrumbs = array(
	'Выполнение PHP-кода',
);
$this->layout = 'main';
$this->pageTitle = 'Выполнение PHP-кода';
?>

<div class="row-fluid">
	<div class="span12">
	<?php
	$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id' => 'horizontalForm',
		'type' => 'horizontal',
	)); ?>
	<fieldset>
		<legend>PHP-код</legend>

		<?php echo $form->textAreaRow($model, 'code', array('class' => 'span12', 'rows' => 10, 'style' => 'font-family: monospace;')); ?>
	</fieldset>
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'type' => 'primary', 'label' => 'Выполнить')); ?>
	</div>

<?php if (!empty($model->result)): ?>
	<?php echo $form->textAreaRow($model, 'result', array('class' => 'span12', 'rows' => 10, 'id' => 'textbox', 'style' => 'font-family: monospace;')); ?>
<?php endif; ?>

<script>$(document).delegate('#EvalForm_code', 'keydown', function(e) {
  var keyCode = e.keyCode || e.which;

  if (keyCode == 9) {
    e.preventDefault();
    var start = $(this).get(0).selectionStart;
    var end = $(this).get(0).selectionEnd;

    // set textarea value to: text before caret + tab + text after caret
    $(this).val($(this).val().substring(0, start)
                + "\t"
                + $(this).val().substring(end));

    // put caret at right position again
    $(this).get(0).selectionStart =
    $(this).get(0).selectionEnd = start + 1;
  }
});</script>


<?php $this->endWidget(); ?>