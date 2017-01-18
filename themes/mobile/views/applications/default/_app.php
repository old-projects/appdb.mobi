<a class="row_link" href="<?= $this->createUrl('/applications/default/application', array('platform' => $platform->id, 'category' => $category->latin_name, 'category_id' => $category->id, 'application' => $data->latin_name, 'application_id' => $data->id)) ?>">
	<!-- <img src="<?= Yii::app()->theme->baseUrl ?>/images/<?= $platform->icon ?>"/> -->
	<span class="bold"><?= $data->name ?></span><br />
	<?= CHtml::encode($data->short_description) ?>
</a>