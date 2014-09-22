<?php

$this->breadcrumbs = array(
    $model->label(2) => array('index'),
);


Yii::app()->clientScript->registerScript('search', "
$(document).ready(function(){
    $('.navbar-nav li').eq(0).addClass('active');
    $('select').addClass('form-control').css({'width':'75px','margin':'0 10px','display':'inline'});
    $('select').eq(2).css('width','90px');

    $('.catIsDisabled').closest('tr').css('color', 'silver');
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
    <div class="row">
        <div class="col-md-12" style="margin: 20px">
            <div class="search-form">
                <?php $this->renderPartial('_search', array(
                    'model' => $model,
                )); ?>
            </div><!-- search-form -->
        </div>
    </div>
    <div class="row">

        <div>
            <div class="form-group" style="float: right; padding: 0 15px">
                <a href="/news/create" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-file"></span> Создать статью</a>
            </div><!-- form -->
        </div>
    </div>

<?php

$this->widget('bootstrap.widgets.BsGridView', array(
    'id' => 'message-grid',
    'type' => 'striped bordered condensed',
    'dataProvider' => $model->search(),
    'template' => '{summary}{items}{pager}',
    'enablePagination' => true,
    'afterAjaxUpdate' => 'js:function(id, data) {
                           $(".catIsDisabled").closest("tr").css("color", "silver");
                        }',
    'columns' => array(
        array( 'name' => 'intNewID', 'header' => 'ID', 'type' => 'raw', 'value' => function($data) {
                return $data->intCategory->isActive ? $data->intNewID : "<span class='catIsDisabled'>" . $data->intNewID . '</span>';
            }),
        array( 'name' => 'varTitle', 'header' => 'Заголовок', 'sortable' => false, 'htmlOptions'=>array('style'=>'width:500px'),),
        array( 'name' => 'intCategory', 'header' => 'Категория', 'sortable' => true),
        array( 'name' => 'isFree', 'header' => 'Бесплатная', 'value' => '$data->isFree ? "Да" : "Нет"' ),
        array( 'name' => 'isPublic', 'value' => '$data->isPublic ? "Да" : "Нет"' ),
        array(
            //'name' => 'Операции',
            'class' => 'bootstrap.widgets.BsButtonColumn',
            'template' => '{update}',
        ),
        array(
            //'name' => 'Операции',
            'class' => 'bootstrap.widgets.BsButtonColumn',
            'template' => '{delete}',
            'deleteConfirmation'=>"js:'Вы точно хотите удалить статью с ID '+$(this).parent().parent().children(':nth-child(2)').text()+'?'",
            'afterDelete'=>'function(link,success,data){
                if (success) {
                    $("#statusMsg").show();
                }
            }',
        ),
    ),
));
