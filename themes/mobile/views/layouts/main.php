<?= '<?xml version="1.0" encoding="utf-8"?>' ?>
<!DOCTYPE HTML>
<html>
<head>
<META HTTP-EQUIV="Content-Type" Content="text/html; Charset=UTF-8">
<meta name="viewport" content="width=device-width" />
<title><?= CHtml::encode($this->pageTitle) ?></title>
<link rel="icon" href="<?= Yii::app()->theme->baseUrl ?>/favicon.ico" type="image/x-icon">
<link rel="shortcut icon" href="<?= Yii::app()->theme->baseUrl ?>/favicon.ico" type="image/x-icon">
<link rel="stylesheet" type="text/css" href="<?= Yii::app()->theme->baseUrl ?>/style/style.css">
</head>
<body>

<?php if ($this->headerTitle !== false): ?>
	<div class="header">
		<?php if (!empty($this->headerImage)) echo '<img src="'.$this->headerImage.'"/>' ?>
		<?= (!empty($this->headerTitle) ? $this->headerTitle : CHtml::encode($this->pageTitle)) ?>
	</div>
<?php endif; ?>

<?php $this->widget('zii.widgets.CBreadcrumbs', array(
	'links' => $this->breadcrumbs,
	'htmlOptions' => array('class' => 'breadcrumbs row'),
	'homeLink' => false,
)); ?>

<?= $content ?>

<div class="navigation"><?php if ($this->homeLink) echo '<a href="'.$this->createAbsoluteUrl('/').'">главная</a> '; ?><a href="<?=$this->createUrl('/site/online')?>">на сайте: <?= OnlineVisitors::model()->active()->users()->count() ?></a></div>
<div class="footer"><a href="<?= $this->createAbsoluteUrl('/') ?>"><?= Yii::app()->request->serverName.' &copy; 2013'.(date('Y') - 2013 > 0 ? ' - '.date('Y') : null) ?></a> - <?= sprintf('%0.5f',Yii::getLogger()->getExecutionTime()); ?></div>
</body>
</html>
