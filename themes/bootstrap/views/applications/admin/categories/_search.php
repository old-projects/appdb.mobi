<div class="wide form">

<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'htmlOptions' => array('class' => 'well'),
	'type' => 'search',
)); ?>

	<?php echo $form->textFieldRow($model, 'id', array('size' => 10,'maxlength' => 10)); ?>

	<?php
		/*<?php echo $form->textFieldRow($model,'root',array('size'=>10,'maxlength'=>10)); ?>

		<?php echo $form->textFieldRow($model,'lft',array('size'=>10,'maxlength'=>10)); ?>

		<?php echo $form->textFieldRow($model,'rgt',array('size'=>10,'maxlength'=>10)); ?>

		<?php echo $form->textFieldRow($model,'level'); ?>*/
	?>

	<?php echo $form->textFieldRow($model, 'name', array('size' => 60,'maxlength' => 100)); ?>

	<?php echo $form->textFieldRow($model, 'description', array('rows' => 6, 'cols' => 50)); ?>

	<?php echo $form->textFieldRow($model, 'latin_name', array('size' => 60,'maxlength' => 100)); ?>

	<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'label' => 'Искать')); ?>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
