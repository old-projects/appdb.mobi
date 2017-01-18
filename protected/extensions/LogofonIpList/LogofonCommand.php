<?php
/**
 * @author wapmorgan
 */
class LogofonCommand extends CConsoleCommand {

	public function init() {
		parent::init();
		Yii::import('ext.LogofonIpList.*');
	}

	/**
	 * Updates database
	 */
	public function actionIndex($quiet = false) {
		$xml = file_get_contents('http://www.logofon.ru/xml/ips.xml');
		$total_operators = LogofonOperators::model()->count();
		$total_ranges = LogofonRanges::model()->count();
		LogofonOperators::model()->deleteAll();
		LogofonRanges::model()->deleteAll();
		foreach (simplexml_load_string($xml) as $xml_operator) {
			$operator = new LogofonOperators;
			$operator->name = $xml_operator->attributes()->name;
			$operator->label = $xml_operator->attributes()->label;
			$operator->tld = $xml_operator->attributes()->tld;
			$operator->country = $xml_operator->attributes()->country;
			$operator->save();
			foreach ($xml_operator->children() as $xml_range) {
				$range = new LogofonRanges;
				$range->operator_id = $operator->id;
				$range->start = $xml_range->attributes()->ip1;
				$range->end = $xml_range->attributes()->ip2;
				$range->save();
			}
		}
		if (!$quiet) {
			echo 'Operators: '.($count = LogofonOperators::model()->count()).($count != $total_operators ? ' ('.sprintf('%+d', $count - $total_operators).')' : null).PHP_EOL;
			echo 'Ranges: '.($count = LogofonRanges::model()->count()).($count != $total_ranges ? ' ('.sprintf('%+d', $count - $total_ranges).')' : null).PHP_EOL;
		}
	}

	/**
	 * Init database.
	 * Creates tables logofon_operators and logofon_ranges using schema from schema.mysql.sql
	 */
	public function actionInitDb() {
		if (!file_exists(dirname(__FILE__).'/schema.mysql.sql')) {
			echo 'schema.mysql.sql is missing.'.PHP_EOL;
			return 1;
		}
		Yii::app()->db->createCommand(file_get_contents(dirname(__FILE__).'/schema.mysql.sql'))->execute();
		echo 'Ok'.PHP_EOL;
	}
}
