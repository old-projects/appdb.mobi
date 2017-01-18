<?php

class EvalForm extends CFormModel {

	public $code;
	public $result;

	/**
	 * Declares the validation rules.
	 */
	public function rules() {
		return array(
			array('code', 'required'),
		);
	}

	public function attributeLabels() {
		return array(
			'code' => 'Код',
		);
	}

	public function evaluate() {
		$prev_error_handler = set_error_handler(array($this, 'errorHandler'));
		ob_start();
		eval($this->code);
		$this->result = ob_get_contents();
		ob_end_clean();

		set_error_handler($prev_error_handler);
	}

	public function errorHandler($code, $message, $file, $line) {

	}
}