<?php
$this->breadcrumbs = array(
	'Посетители с других сайтов',
);
$this->layout = 'main';
$this->pageTitle = 'Внешние переходы с других сайтов';
?>
<div class="row-fluid">
	<div class="span10">
		<h2><?= CHtml::encode($this->pageTitle) ?></h2>

		<?php $this->widget('bootstrap.widgets.TbGridView', array(
			'type' => 'bordered',
			'dataProvider' => $dataProvider,
			'template' => "{items}\n{pager}",
			'columns' => array(
				'day',
				'count',
				'link' => array(
					// 'name' => 'asd',
					'value' => 'CHtml::link("Перейти к сайтам ⇾", Yii::app()->controller->createUrl("visitors", array("day" => $data->day)))',
					'type' => 'raw',
				),
			)
		));
		?>
	</div>
</div>
