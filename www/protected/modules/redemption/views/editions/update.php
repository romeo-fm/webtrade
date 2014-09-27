<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	Yii::t('app', 'Изменение'),
);
?>

<div class="row">
    <div class="col-md-2">
        <a id="goBack" href="#" class="btn btn-primary"><span class="glyphicon glyphicon-hand-left"></span> Вернуться</a>
    </div>

</div>


<?php
$this->renderPartial('_form', array(
		'model' => $model,
		'modelNews' => $modelNews,
        'modelEditionsNews' => $modelEditionsNews,
));
?>