<?php

class MysqlForm extends CFormModel {

	public $query;
	public $select;

	/**
	 * Declares the validation rules.
	 */
	public function rules() {
		return array(
			array('query', 'required'),
			array('select', 'boolean'),
		);
	}

	public function attributeLabels() {
		return array(
			'query' => 'Запрос',
			'select' => 'Запрос на вывод',
		);
	}
}