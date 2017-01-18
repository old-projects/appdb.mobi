<?php
$this->pageTitle = 'Аутентификация';
?>
<div class="form">
<?php $form = $this->beginWidget('CActiveForm', array(
	'id' => 'login-form',
)); ?>

<?php echo $form->errorSummary($model, '', null, array('class' => 'errorSummary row')); ?>

	<div class="row">
		<?php echo $form->labelEx($model, 'username'); ?>
		<?php echo $form->textField($model, 'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'password'); ?>
		<?php echo $form->passwordField($model, 'password'); ?>
	</div>

	<div class="row rememberMe">
		<?php echo $form->checkBox($model, 'rememberMe'); ?>
		<?php echo $form->label($model, 'rememberMe'); ?>
	</div>

	<div class="row buttons centered">
		<?php echo CHtml::submitButton('Войти'); ?> <a href="<?= $this->createUrl('site/registration') ?>" class="button">Регистрация</a>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
