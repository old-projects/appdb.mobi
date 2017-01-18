<?php

Yii::import('zii.widgets.CListView');

class ListView extends CListView {
	public $emptyCssClass;

	/**
	 * Renders the empty message when there is no data.
	 */
	public function renderEmptyText()
	{
		$emptyText=$this->emptyText===null ? Yii::t('zii','No results found.') : $this->emptyText;
		$emptyCssClass = ($this->emptyCssClass === null)
			? 'empty'
			: $this->emptyCssClass;
		echo CHtml::tag('div', array('class' => $emptyCssClass), $emptyText);
	}
}
