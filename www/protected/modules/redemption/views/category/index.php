<?php

$this->breadcrumbs = array(
    $model->label(2) => array('./category'),
);


Yii::app()->clientScript->registerScript('search', "
$(document).ready(function(){
    $('.button-column').eq(0).text('Редактировать').css('width','150px');
    $('td').each(function() {
          if ($(this).text() == 'Нет') {
            $(this).closest('tr').css('color','silver')
          }
    })
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


    <div class="row">

        <div>
            <div class="form-group" style="float: right; padding: 0 15px">
                <a href="./create" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-file"></span>Создать новую рубрику</a>
            </div><!-- form -->
        </div>
    </div>

<?php
$this->widget('bootstrap.widgets.BsGridView', array(
    'id' => 'category-grid',
    'type' => 'striped bordered condensed',
    'dataProvider' => $model->search(),
    'template' => '{summary}{items}{pager}',
    'enablePagination' => true,
    'afterAjaxUpdate' => "js:function(id, data) {
         $('.button-column').eq(0).text('Редактировать').css('width','150px');
            $('td').each(function() {
                  if ($(this).text() == 'Нет') {
                    $(this).closest('tr').css('color','silver')
                  }
            })
    }",
    'columns' => array(
        array( 'name' => 'intCategoryID', 'header' => 'ID', 'sortable' => false),
        array( 'name' => 'varTitle', 'header' => 'Название', 'htmlOptions'=>array('style'=>'width:500px'),),
        array( 'name' => 'isActive', 'header' => 'Статус', 'value' => '$data->isActive ? "Да" : "Нет"',),
        array(
            //'name' => 'Операции',
            'class' => 'bootstrap.widgets.BsButtonColumn',
            'template' => '{update}',
            //'template' => '{view} {update} {delete}',
        ),
        //array('class' => 'bootstrap.widgets.BsButtonColumn', 'template' => '{delete}' ),
    ),
));