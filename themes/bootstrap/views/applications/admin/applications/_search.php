<div class="wide form">

<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
	'htmlOptions' => array('class' => 'well'),
	'type' => 'search',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id',array('size' => 10,'maxlength' => 10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fourpda_topic_id'); ?>
		<?php echo $form->textField($model,'fourpda_topic_id',array('size' => 10,'maxlength' => 10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size' => 60,'maxlength' => 200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'latin_name'); ?>
		<?php echo $form->textField($model,'latin_name',array('size' => 60,'maxlength' => 200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'short_description'); ?>
		<?php echo $form->textArea($model,'short_description',array('rows' => 6, 'cols' => 50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'long_description'); ?>
		<?php echo $form->textArea($model,'long_description',array('rows' => 6, 'cols' => 50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'latest_version'); ?>
		<?php echo $form->textField($model,'latest_version',array('size' => 60,'maxlength' => 100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status'); ?>
		<?php echo $form->textField($model,'status',array('size' => 6,'maxlength' => 6)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'add_time'); ?>
		<?php echo $form->textField($model,'add_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'update_time'); ?>
		<?php echo $form->textField($model,'update_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'platform'); ?>
		<?php echo $form->textField($model,'platform',array('size' => 7,'maxlength' => 7)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'type'); ?>
		<?php echo $form->textField($model,'type',array('size' => 7,'maxlength' => 7)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->