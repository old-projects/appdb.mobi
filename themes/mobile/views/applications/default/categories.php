<?php
if (empty($category))
	$this->pageTitle = 'Игры и приложения для '.$platform->label;
else {
	$this->pageTitle = $category->name.' - '.$platform->label;
	$this->headerTitle = CHtml::encode('Игры и приложения для '.$platform->label);
	$this->breadcrumbs = array(
		$platform->label => array('', 'platform' => $platform->id),
	);
	$breadcrumbs = array(
		$category->name,
	);
	;
	$item = $category;
	while (($parent = $item->parent()->fromCache()->find()) !== null) {
		$breadcrumbs[$parent->name] = array('', 'platform' => $platform->id, 'category' => $parent->latin_name, 'category_id' => $parent->id);
		$item = $parent;
	}
	$this->breadcrumbs = array_merge($this->breadcrumbs, array_reverse($breadcrumbs));

}
?>


<?php
// костыль, чтобы верно определить страницу
if (!empty($apps_provider))
	$apps_provider->getData();
if (empty($apps_provider) || $apps_provider->pagination->currentPage == 0) {
$this->widget('zii.widgets.CListView', array(
	'dataProvider' => $subcategories_provider,
	'itemView' => '_category',
	'template' => '{items}',
	'emptyText' => '',
	'viewData' => array('platform' => $platform),
));
}
?>

<?php if (!empty($category)): ?>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider' => $apps_provider,
	'itemView' => '_app',
				   // костыль on
	'emptyText' => '<div class="row">В данной категории нет приложений.</div>',
				   // костыль off
	'viewData' => array('platform' => $platform, 'category' => $category),
)); ?>
<?php endif; ?>
