<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	Yii::t('app', 'Изменить'),
);


Yii::app()->clientScript->registerScript('search', "
$(document).ready(function(){
    $('#NewsComments_varText,#NewsComments_isApproved,input,select').not(\"[type='submit']\").addClass('form-control').css('display','inline').css('width','300px');
    $('#NewsComments_varText').css('width','900px').css('height', '150px');
})
");

?>

<?php
$this->renderPartial('_form', array(
		'model' => $model,
		'modelNew' => $modelNew));
?>