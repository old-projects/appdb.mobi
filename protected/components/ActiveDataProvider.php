<?php
class ActiveDataProvider extends CActiveDataProvider {
	/**
	 * Returns the pagination object.
	 * @param string $className the pagination object class name. Parameter is available since version 1.1.13.
	 * @return CPagination|false the pagination object. If this is false, it means the pagination is disabled.
	 */
	public function getPagination($className='CPagination')
	{
		$pagination = parent::getPagination($className);
		if ($pagination !== false && $pagination->pageVar != 'page')
			$pagination->pageVar = 'page';
		return $pagination;
	}
}
