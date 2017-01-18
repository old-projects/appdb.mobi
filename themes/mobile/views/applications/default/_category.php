<a class="row_link" href="<?= $this->createUrl('/applications/default/categories', array('platform' => $platform->id, 'category' => $data->latin_name, 'category_id' => $data->id)) ?>">
	<img src="<?= Yii::app()->theme->baseUrl ?>/images/<?= $platform->icon ?>"/>
	<span class="bold"><?= CHtml::encode($data->name) ?></span> (<?= $data->stats->applications_count ?>)<br />
	<span class=""><?= CHtml::encode($data->description) ?></span>
</a>