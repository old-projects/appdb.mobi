<?php
$this->pageTitle = 'База данных мобильных игр и приложений';
$this->headerTitle = false;
$this->homeLink = false;
?>
	<?php if (Yii::app()->user->id === null): ?>
	<div class="row centered">
		<a href="<?= $this->createUrl('/site/login/') ?>" class="button major_button">Вход</a>&nbsp;<a href="<?= $this->createUrl('/site/registration/') ?>" class="button major_button">Регистрация</a>
	</div>
	<?php else: ?>
	<div class="navigation">
		Приветствуем тебя, <?= Yii::app()->user->record->username ?>!
		<?php if (Yii::app()->user->isAdmin()): ?>
			<a href="<?= $this->createUrl('/admin/') ?>">Админ-панель</a>
		<?php endif; ?>
		<a href="<?= $this->createUrl('/site/logout/') ?>">Выход</a>
	</div>
	<?php endif; ?>
<div class="header">Меню</div>
<?php foreach (Yii::app()->getModule('applications')->platforms as $platform_id => $platform_data): ?>
<a class="row_link" href="<?= $this->createUrl('/applications/default/categories', array('platform' => $platform_id)) ?>">
	<img src="<?= Yii::app()->theme->baseUrl ?>/images/<?= $platform_data['icon'] ?>" align="left"/>
	<span class="bold">&nbsp;<?= $platform_data['label'] ?></span><br />
	<span class="small">&nbsp;<?= $platform_data['description'] ?></span>
</a>
<?php endforeach; ?>
