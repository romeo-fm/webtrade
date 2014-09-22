<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	Yii::t('app', 'Создание'),
);

Yii::app()->clientScript->registerScript('search', "
$(document).ready(function(){
    $('#Users_isActive,#Users_isAdmin').addClass('form-control').css('display','inline').css('width','300px').val(1);
})
");


?>

<?php
$this->renderPartial('_form', array(
		'model' => $model,
		'buttons' => 'create'));
?>