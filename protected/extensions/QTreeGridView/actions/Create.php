<?php

class Create extends CAction {

    public function run($parent = null) {
        $modelClassName = $this->getController()->CQtreeGreedView['modelClassName'];
        $model = new $modelClassName();
        $this->controller->performAjaxValidation($model);

        if ($parent !== null)
            $parent = $modelClassName::model()->findByPk($parent);

        if (isset($_POST[$this->getController()->CQtreeGreedView['modelClassName']])) {
            $model->attributes = $_POST[$this->getController()->CQtreeGreedView['modelClassName']];

            try {
                if ($parent !== null) {
                    if ($model->appendTo($parent)) {
                        $this->getController()->redirect(array($this->getController()->CQtreeGreedView['adminAction']));
                    }
                } else {
                    if ($model->tree->hasManyRoots == true) {
                        if($model->saveNode()) {
                            // var_dump($model->attributes);
                            $this->getController()->redirect(array($this->getController()->CQtreeGreedView['adminAction']));
                        }
                    } else {
                        $root = CActiveRecord::model($this->getController()->CQtreeGreedView['modelClassName'])->roots()->find();

                        if ($root && $model->appendTo($root)) {
                            $this->getController()->redirect(array($this->getController()->CQtreeGreedView['adminAction']));
                        }
                    }
                }
            } catch (Exception $e) {
                $model->addError("CQTeeGridView", $e->getMessage());
            }
        }

        $this->getController()->render('create', array(
            'model' => $model,
            'parent' => $parent,
        ));
    }
}
?>
