			<div class="well">
				<!-- <h3>Статистика</h3> -->
				<h4>Место на диске</h4>
				<?php
				$free_space = disk_free_space(Yii::getPathOfAlias('application'));
				$total_space = disk_total_space(Yii::getPathOfAlias('application'));
				$free_percent = (int)($free_space * 100 / $total_space);
				?>
				<p>Занято <?= Yii::app()->format->formatSize($total_space - $free_space); ?> из <?= Yii::app()->format->formatSize($total_space); ?> (<?= 100 - $free_percent ?>%)</p>
				<?php $this->widget('bootstrap.widgets.TbProgress', array(
					'type' => ($free_percent < 10 ? 'danger' : 'info'), // 'info', 'success' or 'danger'
					'percent' => 100 - $free_percent, // the progress
				)); ?>
				<h4>Пользователи онлайн</h4>
				<div class="row-fluid">
					<div class="span6">
						<h6>За <?= Yii::t('site', 'последнюю {n} минуту|последние {n} минуты|последние {n} минут|последние {n} минуты', Yii::app()->onlineVisitorsCounter->activeLimitMinutes) ?></h6>
						Реальные посетители: <?= OnlineVisitors::model()->active()->users()->count() ?><br />
						Боты: <?= OnlineVisitors::model()->active()->bots()->count() ?><br />
						Всего: <?= OnlineVisitors::model()->active()->count() ?><br />
					</div>
					<div class="span6">
						<h6>За <?= Yii::t('site', '{n} час|{n} часа|{n} часов|{n} часа', Yii::app()->onlineVisitorsCounter->keepDataHours) ?></h6>
						Реальные посетители: <?= OnlineVisitors::model()->users()->count() ?><br />
						Боты: <?= OnlineVisitors::model()->bots()->count() ?><br />
						Всего: <?= OnlineVisitors::model()->count() ?><br />
					</div>
				</div>
				<?php $this->widget('bootstrap.widgets.TbButton', array(
					'buttonType' => 'link',
					'type' => 'link',
					'url' => $this->createUrl('/admin/online/'),
					'label' => 'Подробнее ⇾',
					'block' => true,
					'htmlOptions' => array('style' => 'text-align: right'),
				)) ?>
				<h4>Переходы с внешних сайтов</h4>
				Сегодня: <?= ExternalVisitors::model()->today()->count() ?><br />
				Вчера: <?= ExternalVisitors::model()->yesterday()->count() ?><br />
				За всё время: <?= ExternalVisitors::model()->count() ?><br />
				<?php $this->widget('bootstrap.widgets.TbButton', array(
					'buttonType' => 'link',
					'type' => 'link',
					'url' => $this->createUrl('/admin/visitors/'),
					'label' => 'Подробнее ⇾',
					'block' => true,
					'htmlOptions' => array('style' => 'text-align: right'),
				)) ?>
			</div>
