<?php

$this->breadcrumbs = array(
    $model->label(2) => array('index'),
);

Yii::app()->clientScript->registerScript('search', "
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

    <div class="row" id="statusErrMsg" style="display: <?php echo isset($_REQUEST['err']) ? 'block' : 'none' ?>">
        <div class="col-md-12" style="margin: 20px;padding-right: 50px">
            <div>
                <a href="#" class="btn btn-block btn-sm btn-info">
                    <span class="glyphicon glyphicon-check"></span>Ошибка сохранения данных!</a>
            </div>
        </div>
    </div>


    <div class="row">

        <div>
            <div class="form-group" style="float: right; padding: 0 15px">
                <a href="/users/create" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-file"></span>Создать пользователя</a>
            </div><!-- form -->
        </div>
    </div>

<?php
$this->widget('bootstrap.widgets.BsGridView', array(
    'id' => 'users-grid',
    'type' => 'striped bordered condensed',
    'dataProvider' => $model->search(),
    'template' => '{summary}{items}{pager}',
    'enablePagination' => true,
    'columns' => array(
        array(
            'name'=>'intUserID',
            'value'=>'$data->intUserID',
            'sortable' => false,
            'htmlOptions'=>array('style'=>'width:80px'),
        ),
        array(
            'name'=>'varName',
            'value'=>'$data->varName',
            'sortable' => false,
            'htmlOptions'=>array('style'=>'width:300px'),
        ),
        array(
            'name'=>'isActive',
            'value'=>'$data->isActive ? "Да" : "Нет"',
            'sortable' => false,
            'htmlOptions'=>array('style'=>'width:200px'),
        ),
        array(
            'name'=>'isAdmin',
            'value'=>'$data->isAdmin ? "Да" : "Нет"',
            'sortable' => false,
        ),

        array(
            //'name' => 'Операции',
            //'class' => 'CButtonColumn',
            'class' => 'bootstrap.widgets.BsButtonColumn',
            'template' => '{update} {delete}',
            'deleteConfirmation'=>"js:'Вы точно хотите удалить запись с ID '+$(this).parent().parent().children(':nth-child(2)').text()+'?'",
            'afterDelete'=>'function(link,success,data){
                if (success) {
                    $("#statusMsg").html(data);
                }
                setTimeout(function() {
                    $(".button-column").eq(0).text("Действия").css("width","120px")
                }, 500);


            }',
            'buttons' => array(
                'delete' => array(
                    'label'=>'Удалить',
                    /*
                        'label'=>'...',     //Text label of the button.
                        'url'=>'...',       //A PHP expression for generating the URL of the button.
                        'imageUrl'=>'...',  //Image URL of the button.
                        'options'=>array(), //HTML options for the button tag.
                        'click'=>'...',     //A JS function to be invoked when the button is clicked.
                        'visible'=>'...',   //A PHP expression for determining whether the button is visible.
                     */
                ),
                'update' => array(
                    'label'=>'Изменить',
                ),
            ),
        ),
    ),
));

