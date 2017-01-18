<?php
Yii::app()->clientScript->registerCoreScript('jquery.ui');
$module_links = array();
foreach (array_diff_key(Yii::app()->getModules(), array('gii' => null)) as $module=>$config) {
	$module = Yii::app()->getModule($module);
	if (!($module instanceof AdminableModule))
		continue;
	$module_links[] = array('label' => $module->adminLinkTitle, 'url' => array('/'.$module->id.'/'.$module->adminLink));
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/styles.css" />
	<title><?= Yii::app()->request->serverName ?>:<?php echo CHtml::encode($this->pageTitle); ?></title>
	<link rel="icon" href="<?= Yii::app()->theme->baseUrl ?>/favicon.ico" type="image/x-icon">
	<link rel="shortcut icon" href="<?= Yii::app()->theme->baseUrl ?>/mobile/favicon.ico" type="image/x-icon">
<style>
.breaked {
	word-break: break-all;
}
.small {
	font-size: 0.8em;
}
#page {
	/*padding-top: 60px;*/
}
</style>

	<?php Yii::app()->bootstrap->register(); ?>
</head>

<body>

<?php $this->widget('bootstrap.widgets.TbNavbar',array(
	'type' => 'inverse',
	'brand' => Yii::app()->name,
	'brandUrl' => $this->createUrl('/admin'),
	'fluid' => true,
	'fixed' => false,
	'collapse' => false,
	'items' => array(
		array(
			'class' => 'bootstrap.widgets.TbMenu',
			'items' => Cmap::mergeArray(array(
				array('label' => Yii::app()->request->serverName, 'url' => '#', 'icon' => (Yii::app()->settings->get('site', 'siteClosed') ? 'remove white' : null), 'items' => array(
					array('label' => 'Настройки сайта', 'url' => $this->createUrl('/admin/settings')),
					array('label' => 'Online', 'url' => $this->createUrl('/admin/online')),
					array('label' => 'Переходы с других сайтов', 'url' => $this->createUrl('/admin/visitors')),
				)),
			), $module_links),
		),
		array(
			'class' => 'bootstrap.widgets.TbMenu',
			'htmlOptions' => array('class'=>'pull-right'),
				'items' => array(
				array('label' => 'Разработчику', 'icon' => 'wrench white', 'url' => '#',
					'items' => array(
						array('label' => 'MySQL', 'url' => $this->createUrl('/admin/mysql'), 'visible' => Yii::app()->user->checkAccess('executeMysql')),
						array('label' => 'PHP', 'url' => $this->createUrl('/admin/eval'), 'visible' => Yii::app()->user->checkAccess('executeMysql')),
					),
					'visible' => Yii::app()->user->isDeveloper()),
				array('label' => 'На сайт ⇾', 'url' => $this->createAbsoluteUrl('/')),
			),
		),
	),
)); ?>

<div class="container-fluid" id="page">
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
			'homeLink' => CHtml::link(Yii::t('zii', 'Админ-панель'), $this->createUrl('/admin')),
			'links' => $this->breadcrumbs,
		)); ?>
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>
	<hr />
		<footer>

			<div class="row">

				<div class="span6">

					<p class="powered">
					Copyright &copy; 2013<?= (date('Y') - 2013 > 0 ? ' - '.date('Y') : null) ?> by wapmorgan.<br/>
					All Rights Reserved.<br/>
					<?php echo Yii::powered(); ?>
					</p>
				</div>
			</div>
		</footer>


</div><!-- page -->


</body>
</html>
