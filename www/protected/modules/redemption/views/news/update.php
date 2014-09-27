<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	Yii::t('app', 'Изменить'),
);


Yii::app()->clientScript->registerScript('search', "
$(document).ready(function(){
    $('.navbar-nav li').eq(0).addClass('active');
    $('#News_isFree,#News_intCategoryID').addClass('form-control').css('display','inline').css('width','300px');
})
");
?>

    <div class="row" id="statusUpdMsg" style="display: <?php echo isset($_REQUEST['suc']) ? 'block' : 'none' ?>">
        <div class="col-md-12" style="margin: 20px;padding-right: 50px">
            <div>
                <a href="#" class="btn btn-block btn-sm btn-info">
                    <span class="glyphicon glyphicon-check"></span> Данные успешно сохранены!</a>
            </div>
        </div>
    </div>

<?php
$this->renderPartial('_form', array(
		'model' => $model));
?>