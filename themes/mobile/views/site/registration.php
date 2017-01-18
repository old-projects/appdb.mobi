<?php
$this->pageTitle = 'Регистрация';
?>
<div class="row">
	Чтобы воспользоваться всеми возможностями сайта вам следует зарегистрироваться на сайте. <br /> Вы можете самостоятельно ввести пароль или email. Во втором случае пароль будет выбран системой и отправлен вам на почту.
</div>
<div class="form">
<?php $form = $this->beginWidget('CActiveForm', array(
	'id' => 'registration-form',
)); ?>

<?php echo $form->errorSummary($model, '', null, array('class' => 'errorSummary row')); ?>

	<div class="row">
		<?php echo $form->label($model, 'username'); ?>
		<?php echo $form->textField($model, 'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'password'); ?>
		<?php echo $form->passwordField($model, 'password'); ?><br />
		или<br />
		<?php echo $form->label($model, 'email'); ?>
		<?php echo $form->emailField($model, 'email'); ?>
	</div>

	<div class="row buttons centered">
		<?php echo CHtml::submitButton('Зарегистрироваться'); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
