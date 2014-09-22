<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	Yii::t('app', 'Создать'),
);

Yii::app()->clientScript->registerScript('search', "
$(document).ready(function(){
    $('#Category_isActive').addClass('form-control').css('display','inline').css('width','300px').val(1);
})
");
?>


<?php
$this->renderPartial('_form', array(
		'model' => $model,
		'buttons' => 'create'));
?>