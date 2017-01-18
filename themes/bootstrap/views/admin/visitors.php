<?php
$this->breadcrumbs = array(
	'Посетители с других сайтов' => $this->createUrl('visitors'),
	'Переходы за '.$day => $this->createUrl('visitors', array('day' => $day)),
	'Переходы с сайта '.$site,
);
$this->layout = 'main';
$this->pageTitle = 'Переходы с '.$site.' за '.$day;
?>
<div class="row-fluid">
	<div class="span10">
		<h2><?= CHtml::encode($this->pageTitle) ?></h2>
		<h4><?= 'Переходов: '.$dataProvider->totalItemCount ?></h4>

		<?php $this->widget('bootstrap.widgets.TbGridView', array(
			'type' => 'bordered condensed striped',
			'dataProvider' => $dataProvider,
			'template' => "{items}\n{pager}",
			'columns' => array(
				'n' => array(
					'name' => '#',
					'value' => '$this->grid->dataProvider->pagination->offset + $row + 1',
					'cssClassExpression' => '"small"',
					'htmlOptions' => array(
						'width' => '1%',
					),
				),
				'visit_time' => array(
					'name' => 'visit_time',
					'type' => 'time',
				),
				'from' => array(
					'name' => 'Откуда',
					'value' => 'CHtml::link($data->referrer, Yii::app()->baseUrl."/go.php?url=".urlencode($data->referrer))',
					'type' => 'raw',
					'cssClassExpression' => '"breaked"',
				),
				'to' => array(
					'name' => 'Куда',
					'value' => '$data->query',
					'type' => 'url',
					'cssClassExpression' => '"breaked"',
				),
				'address' => array(
					'name' => 'address',
					'type' => 'raw',
					'value' => 'CHtml::link($data->address, Yii::app()->baseUrl."/go.php?url=".urlencode("http://who.is/whois-ip/ip-address/{$data->address}"), array("data-toggle" => "tooltip", "title" => "$data->user_agent"))',
				),
			),
		));
			?>
	</div>
	<div class="span2">
				<?php
				$items = array();
				foreach ($page_size_selector->items as $item=>$label) {
					$link = $page_size_selector->makeLink($item);
					$link[1]['page'] = 0;
					$items[] = array('label' => $label, 'url' => call_user_func_array(array($this, 'createUrl'), $link), 'active' => $page_size_selector->selectedItem == $item);
				}
				$this->widget('bootstrap.widgets.TbMenu', array(
					'type' => 'tabs', // '', 'tabs', 'pills' (or 'list')
					'stacked' => true, // whether this is a stacked menu
					'items' => $items)); ?>
			</div>
</div>
