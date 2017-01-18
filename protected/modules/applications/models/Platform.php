<?php
class Platform extends stdClass {
	static public function getById($id) {
		$platforms = Yii::app()->getModule('applications')->platforms;
		if (!isset($platforms[$id]))
			return null;
		$platform = (object)$platforms[$id];
		$platform->id = $id;
		return $platform;
	}
}