<?php
Yii::import('zii.widgets.grid.CDataColumn');
class DataColumn extends CDataColumn {
	public $data = array();

	/**
	 * Renders the data cell content.
	 * This method evaluates {@link value} or {@link name} and renders the result.
	 * @param integer $row the row number (zero-based)
	 * @param mixed $data the data associated with the row
	 */
	protected function renderDataCellContent($row,$data)
	{
		if($this->value!==null)
			$value=$this->evaluateExpression($this->value, array_merge(array('data'=>$data,'row'=>$row), $this->data));
		elseif($this->name!==null)
			$value=CHtml::value($data,$this->name);
		echo $value===null ? $this->grid->nullDisplay : $this->grid->getFormatter()->format($value,$this->type);
	}
}