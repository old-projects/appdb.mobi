<?php
$this->breadcrumbs = array(
	'Посетители с других сайтов' => $this->createUrl('visitors'),
	'Переходы за '.$day,
);
$this->layout = 'main';
$this->pageTitle = 'Внешние переходы с других сайтов за '.$day;
?>
<div class="row-fluid">
	<div class="span10">
		<h2><?= CHtml::encode($this->pageTitle) ?></h2>
		<h4><?= 'Сайтов: '.$dataProvider->totalItemCount ?></h4>

		<?php $this->widget('bootstrap.widgets.TbGridView', array(
			'type' => 'bordered condensed striped',
			'dataProvider' => $dataProvider,
			'template' => "{items}\n{pager}",
			'columns' => array(
				'referrer_site',
				'count',
				'link' => array(
					// 'name' => 'asd',
					'value' => 'CHtml::link("Переходы ⇾", Yii::app()->controller->createUrl("visitors", array("day" => "'.$day.'", "site" => $data->referrer_site)))',
					'type' => 'raw',
				),
			)
		));
		?>
	</div>
</div>
