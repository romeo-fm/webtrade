<?php

$this->breadcrumbs = array(
);


Yii::app()->clientScript->registerScript('search', "
$(document).ready(function(){
    $('.navbar-nav li').eq(0).addClass('active');

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
    <div class="row" id="statusMsg" style="display: none">
        <div class="col-md-12" style="margin: 20px;padding-right: 50px">
            <div>
                <a href="#" class="btn btn-block btn-sm btn-info">
                    <span class="glyphicon glyphicon-check"></span> Элемент успешно удален</a>
            </div>
        </div>
    </div>

<!--
    <div class="row">
        <div>
            <div class="form-group" style="float: right; padding: 0 15px">
                <a href="/news/create" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-file"></span> Создать статью</a>
            </div>
        </div>
    </div>
-->
