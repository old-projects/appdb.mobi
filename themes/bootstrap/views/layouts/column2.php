<?php $this->beginContent('//layouts/main'); ?>
<div class="row-fluid">
	<div class="span3">
		<div id="sidebar">
			<?php if (!empty($this->menu)): ?>
			<div class="well">
			<?php
				// $this->beginWidget('zii.widgets.CPortlet', array(
				//	 'title'=>'Operations',
				// ));
				$this->widget('bootstrap.widgets.TbMenu', array(
					'items' => $this->menu,
					'type' => 'list',
					'htmlOptions' => array('class' => 'operations'),
				));
				// $this->endWidget();
			?>
			</div>
			<?php endif; ?>
		</div><!-- sidebar -->
	</div>
	<div class="span9">
		<div id="content">
			<?php echo $content; ?>
		</div><!-- content -->
	</div>
</div>
<?php $this->endContent(); ?>