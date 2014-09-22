<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	Yii::t('app', 'Создание'),
);
?>

<div class="row">
    <div class="col-md-2">
        <a id="goBack" href="#" class="btn btn-primary"><span class="glyphicon glyphicon-hand-left"></span> Вернуться</a>
    </div>

</div>

<?php
$this->renderPartial('_form_create', array(
		'model' => $model,
		));
?>