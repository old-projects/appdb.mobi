<?php
$this->pageTitle = $application->name.' - '.($application->type == 'game' ? 'игра' : 'приложение').' для '.$platform->label;

$this->breadcrumbs = array(
	$platform->label => array('', 'platform' => $platform->id),
);
$item = $application->category;
do {
	$breadcrumbs[$item->name] = array('default/categories', 'platform' => $platform->id, 'category' => $item->latin_name, 'category_id' => $item->id);
}
while (($item = $item->parent()->fromCache()->find()) !== null);

$this->breadcrumbs = array_merge($this->breadcrumbs, array_reverse($breadcrumbs), array($application->name));

?>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data' => $application,
	'attributes' => array(
		'id',
		'category' => array(
			'name' => 'category',
			'value' => $application->category->name,
		),
		// 'fourpda_topic_id',
		'name',
		'latin_name',
		'short_description',
		'long_description',
		'latest_version',
		'status',
		'add_time',
		'update_time',
		'platform',
		'type',
	),
)); ?>
