<?php
class StatsCommand extends ConsoleCommand {
	private $stats = array();

	public function import() {
		return array('application.modules.applications.models.*');
	}

	/**
	 * Refreshes categories statistics
	 */
	public function actionRefresh() {
		foreach (Yii::app()->db->createCommand()
			->select('COUNT(*) as apps, platform, COALESCE(SUM(downloads_count), 0) as downloads, category_id')
			->from(Application::model()->tableName())
			->group('category_id, platform')
			->queryAll() as $category_stats) {
			$this->stats[$category_stats['category_id']][$category_stats['platform']] = array('apps' => $category_stats['apps'], 'downloads' => $category_stats['downloads']);
		}

		echo 'Refreshing all stats ...'.PHP_EOL;
			foreach (ApplicationCategory::model()->roots()->findAll() as $root)
				$this->refreshStats($root);
	}

	/**
	 * Обновляет статистику заданной категории
	 * @return array applications_count and downloads_count
	 */
	private function refreshStats(ApplicationCategory $category) {
		// ApplicationCategoryStats::model()->deleteAllByAttributes(array('category_id' => $category->id));
		$stats = array();
		foreach (array_keys(Yii::app()->getModule('applications')->platforms) as $platform) {
			if (($platform_stats = ApplicationCategoryStats::model()->findByPk(array('category_id' => $category->id, 'platform' => $platform))) !== null) {
				$stats[$platform] = $platform_stats;
				$stats[$platform]->downloads_count = 0;
				$stats[$platform]->applications_count = 0;
			} else {
				$stats[$platform] = new ApplicationCategoryStats;
				$stats[$platform]->platform = $platform;
				$stats[$platform]->category_id = $category->id;
			}
		}

		// // считаем количество приложений/скачиваний в категории для каждой из платформ
		// $data = Yii::app()->db->createCommand()
		// 	->select('COUNT(*) as applications_count, platform, COALESCE(SUM(downloads_count), 0) as downloads_count ')
		// 	->from(Application::model()->tableName())
		// 	->where('category_id = :category')
		// 	->group('platform')
		// 	->bindValue(':category', $category->id)
		// 	->queryAll();

		if (isset($this->stats[$category->id])) {
			foreach ($this->stats[$category->id] as $platform => $data_row) {
				$stats[$platform]->downloads_count += $data_row['downloads'];
				$stats[$platform]->applications_count += $data_row['apps'];
			}
		}

		// считаем статистику в подкатегориях
		foreach ($category->children()->findAll() as $child) {
			$data = $this->refreshStats($child);
			foreach ($data as $platform => $platform_stats) {
				$stats[$platform]->downloads_count += $platform_stats->downloads_count;
				$stats[$platform]->applications_count += $platform_stats->applications_count;
			}
		}

		echo str_repeat('- ', $category->level - 1).$category->name.' -';
		foreach ($stats as $platform_stats) {
			echo ' '.$platform_stats->platform{0}.': '.$platform_stats->applications_count;
			$platform_stats->save();
		}
		echo PHP_EOL;

		if ($category->dirty_statistics) {
			$category->dirty_statistics = 0;
			$category->saveNode();
		}

		return $stats;
	}
}
