<?php
$this->breadcrumbs = array(
	'Online',
);
$this->layout = 'main';
$this->pageTitle = 'Онлайн';
$this->headerTitle = 'Онлайн'.($tabs_selector->selectedItem == 'all' ? null : ' '.($tabs_selector->selectedItem == 'bots' ? 'боты' : 'посетители')).' за '.
	($time_selector->selectedItem == 'active'
		? Yii::t('site', 'последнюю {n} минуту|последние {n} минуты|последние {n} минут|последние {n} минуты', $online_active_limit)
		: Yii::t('site', '{n} час|{n} часа|{n} часов|{n} часа', $online_keep_data_limit)
	);
?>
<div class="row-fluid">
	<div class="span10">
		<h2><?= $this->headerTitle ?></h2>
		<h4><?= ($tabs_selector->selectedItem == 'all' ? 'Онлайн' : ($tabs_selector->selectedItem == 'bots' ? 'Боты' : 'Посетители')).': '.$dataProvider->totalItemCount ?></h4>
						<!-- zii.widgets.grid.CGridView -->
		<?php $this->widget('bootstrap.widgets.TbGridView', array(
			'type' => 'bordered',
			'rowCssClassExpression' => '($row % 2 == 0 ? "odd" : "oven").($data->is_bot ? " warning" : null);',
			'dataProvider' => $dataProvider,
			'template' => "{items}\n{pager}",
			'columns' => array(
				'#' => array(
					'name' => '#',
					'value' => '$row + 1',
				),
				'refresh_last_time' => array(
					'name' => 'refresh_last_time',
					'value' => 'Yii::app()->dateFormatter->formatDateTime($data->refresh_last_time, strtotime($data->refresh_last_time) > strtotime("today") ? null : "medium")',
					'type' => 'raw',
				),
				'refreshes_count',
				'address' => array(
					'name' => 'address',
					'type' => 'raw',
					'value' => '(
						!empty($data->operator)
						? CHtml::tag("span", array("class" => "badge"
							.($data->operator->isBeeline() ? " badge-warning"
							: ($data->operator->isMts() ? " badge-important"
							: ($data->operator->isMegafon() ? " badge-success"
							: ($data->operator->isOperaMini() ? " badge-info"
							: null))))
							), $data->operator->name)." "
						: null)
						.CHtml::link($data->address, Yii::app()->baseUrl."/go.php?url=".urlencode("http://who.is/whois-ip/ip-address/{$data->address}"))',
					// 'cssClassExpression' => '',
				),
				'user_agent' => array(
					'name' => 'user_agent',
					'cssClassExpression' => '"breaked"',
				),
				'query' => array(
					'name' => 'query',
					'value' => 'CHtml::link($data->query, $data->query)',
					'type' => 'raw',
					'cssClassExpression' => '"breaked"',
				),
				'referrer' => array(
					'name' => 'referrer',
					'value' => 'parse_url($data->referrer, PHP_URL_HOST) == Yii::app()->request->serverName
						? CHtml::link($data->referrerPath, $data->referrerPath)
						: CHtml::link($data->referrer, Yii::app()->baseUrl."/go.php?url=".urlencode($data->referrer))',
					'type' => 'raw',
					'cssClassExpression' => '"breaked"',
				),
				'flags' => array(
					'name' => 'Флаги',
					// 'value' => 'var_dump($data->operator)',
					'type' => 'raw',
				),
			),
			));
			?>
	</div>
	<div class="span2">
		<?php
		$items = array();
		foreach ($tabs_selector->items as $item=>$label) {
			$items[] = array('label' => $label, 'url' => call_user_func_array(array($this, 'createUrl'), $tabs_selector->makeLink($item)), 'active' => $tabs_selector->selectedItem == $item);
		}
		$this->widget('bootstrap.widgets.TbMenu', array(
			'type' => 'tabs', // '', 'tabs', 'pills' (or 'list')
			'stacked' => true, // whether this is a stacked menu
			'items' => $items)); ?>
		<?php
		$items = array();
		foreach ($time_selector->items as $item=>$label) {
			$items[] = array('label' => $label, 'url' => call_user_func_array(array($this, 'createUrl'), $time_selector->makeLink($item)), 'active' => $time_selector->selectedItem == $item);
		}
		$this->widget('bootstrap.widgets.TbMenu', array(
			'type' => 'tabs', // '', 'tabs', 'pills' (or 'list')
			'stacked' => true, // whether this is a stacked menu
			'items' => $items)); ?>
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
