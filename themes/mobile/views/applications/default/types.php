<?php
$this->pageTitle = 'Приложения и игры для '.$platform->label;
?>

<?php foreach ($this->module->types as $type_id => $type_data): ?>
<a class="row_link" href="<?= $this->createUrl('/applications/default/index', array('platform' => $platform->id, 'type' => $type_id)) ?>">
	<img src="<?= Yii::app()->theme->baseUrl ?>/images/<?= $type_data['icon'] ?>.32.png" align="left"/>
	<span class="bold">&nbsp;<?= $type_data['label'] ?></span><br />
</a>
<?php endforeach; ?>