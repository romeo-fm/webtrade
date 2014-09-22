<?php

$this->breadcrumbs = array(
    $model->label(2) => array('index'),
);

Yii::app()->clientScript->registerScript('search', "
$(document).ready(function(){
    $('.button-column').eq(0).text('Редактировать').css('width','120px');
    $('.button-column').eq(1).text('Просмотр').css('width','80px');
    $('td').each(function() {
      if ($(this).text() == 'Нет') {
        $(this).closest('tr').css('color','silver')
      }
    })
})
");
?>
<!--

<?php /*echo GxHtml::link(Yii::t('app', 'Advanced Search'), '#', array('class' => 'search-button')); */?>
    <div class="search-form">
        <?php /*$this->renderPartial('_search', array(
            'model' => $model,
        )); */?>
    </div>
-->

    <div class="row">

        <div>
            <div class="form-group" style="float: right; padding: 0 15px">
                <a href="/editions/create" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-file"></span> Создать выпуск</a>
            </div><!-- form -->
        </div>
    </div>

<?php

$this->widget('bootstrap.widgets.BsGridView', array(
    'id' => 'editions-grid',
    'type' => 'striped bordered condensed',
    'dataProvider' => $model->search(),
    'template' => '{summary}{items}{pager}',
    'enablePagination' => true,
    'afterAjaxUpdate' => "js:function(id, data) {
                    $('.button-column').eq(0).text('Редактировать').css('width','120px');
                    $('.button-column').eq(1).text('Просмотр').css('width','80px');
                    $('td').each(function() {
                      if ($(this).text() == 'Нет') {
                        $(this).closest('tr').css('color','silver')
                      }
                    })

                }",
    'columns' => array(
        array(
            'name'=>'intEditionID',
            'value'=>'$data->intEditionID',
            'sortable' => false,
            'htmlOptions'=>array('style'=>'width:80px'),
        ),
        array(
            'name'=>'intNumByMonth',
            'value'=>'$data->intNumByMonth',
            'sortable' => false,
            //'htmlOptions'=>array('style'=>'width:10px'),
        ),
        array(
            'name'=>'intMonth',
            'value'=>'$data->intMonth',
            'sortable' => false,
           // 'htmlOptions'=>array('style'=>'width:10px'),
        ),
        array(
            'name'=>'intYear',
            'value'=>'$data->intYear',
            'sortable' => false,
            //'htmlOptions'=>array('style'=>'width:10px'),
        ),
        array(
            'name'=>'isPublic',
            'value'=>'$data->isPublic ? "Да" : "Нет"',
            'sortable' => false,
            'htmlOptions'=>array('style'=>'width:120px'),
        ),
        array(
            'name'=>'Статей в выпуске',
            'value'=> '$data->numNewsInEdition',
            'sortable' => false,
            'htmlOptions'=>array('style'=>'width:160px'),
        ),

        array(
            //'name' => 'Операции',
            'class' => 'bootstrap.widgets.BsButtonColumn',
            'template' => '{update}',
            'deleteConfirmation'=>"js:'Вы точно хотите удалить запись с ID '+$(this).parent().parent().children(':nth-child(2)').text()+'?'",
            'afterDelete'=>'function(link,success,data){
                if (success) {
                    $("#statusMsg").html(data);
                }

            }',
            'buttons' => array(
                'update' => array(
                    'label'=>'Изменить',
                    'visible' => '!$data->isPublic'
                ),
            ),
        ),
        array(
            //'name' => 'Операции',
            'class' => 'bootstrap.widgets.BsButtonColumn',
            'template' => '{view}',
            'deleteConfirmation'=>"js:'Вы точно хотите удалить запись с ID '+$(this).parent().parent().children(':nth-child(2)').text()+'?'",
            'afterDelete'=>'function(link,success,data){
                if (success) {
                    $("#statusMsg").html(data);
                }

            }',
            'buttons' => array(
                'update' => array(
                    'label'=>'Изменить',
                    'visible' => '!$data->isPublic'
                ),
            ),
        ),
    ),
));