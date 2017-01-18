<?php
$this->pageTitle = 'Онлайн';
$this->headerTitle = 'Онлайн посетители за последние '.Yii::t('site', '{n} минуту|{n} минуты|{n} минут|{n} минуты', $online_active_limit);
?>
<?php if ($detailed): ?>
<div class="row centered">Сортировка: <? $this->widget('SelectorWidget', array('selector' => $sorting_selector)) ?></div>
<?php endif; ?>
<div class="row centered">Выборка: <? $this->widget('SelectorWidget', array('selector' => $bots_selector)) ?></div>
<?php if ($detailed): ?>
<div class="row">
	<table border="1px" width="100%">
		<tr>
			<th>№</th>
			<th>Время</th>
			<th>Переходов</th>
			<th>Браузер</th>
			<th>IP</th>
			<th>Начал ходить</th>
			<th>Страница</th>
			<th>Реферер</th>
			<th>Внешний Реферер</th>
			<th>Флаги</th>
		</tr>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider' => $dataProvider,
	'itemView' => '_online_user_table',
	'template' => "{items}",
	'viewData' => array(
		'server_name' => Yii::app()->request->serverName,
		'host_info' => Yii::app()->request->hostInfo,
		'user_host_address' => Yii::app()->request->userHostAddress,
		'user_agent' => Yii::app()->request->userAgent,
	),
)); ?>
	</table>
	<?php $this->widget('CLinkPager',array('pages' => $dataProvider->pagination)); ?>
</div>
<?php else: ?>
<?php $this->widget('ListView', array(
	'dataProvider' => $dataProvider,
	'itemView' => '_online_user',
	'template' => "{items}\n{pager}",
	'viewData' => array('detailed' => $detailed),
)); ?>
<?php endif; ?>
