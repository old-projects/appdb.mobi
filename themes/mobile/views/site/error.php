<?php
$this->pageTitle = 'Ошибка на сервере! О_О';
$this->headerTitle = 'Ошибка #'.$code;
?>
<div class="row">
<?php echo CHtml::encode($message); ?>
</div>