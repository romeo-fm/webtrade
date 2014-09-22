<?php

$this->breadcrumbs = array(
    $model->label(2) => array('index'),
    Yii::t('app', 'Создать'),
);

Yii::app()->clientScript->registerScript('search', "
$(document).ready(function(){
    $('.navbar-nav li').eq(0).addClass('active');
    $('#News_isFree,#News_intCategoryID').addClass('form-control').css('display','inline').css('width','300px');
})
");


?>


<?php
$this->renderPartial('_form', array(
		'model' => $model,
		'buttons' => 'create'));
?>