<?php
Yii::app()->clientScript->registerScript('search', "
$(document).ready(function(){
    $('.catIsDisabled').closest('tr').css('color','silver');

    $('.newAdd').live('click', function() {
        var edID = $('#Editions_intEditionID').val();
        var newID = $(this).closest('tr').children('td').eq(0).text();
        var catIsDisabled = $(this).closest('tr').children('td').eq(0).children('.catIsDisabled').length;
        var newIsPublic = $(this).closest('tr').children('td').children('span.newIsPublic').length;
        var fl = 1;

        if (newIsPublic) {
            fl = 0;
            if (confirm('Эта новость уже была опубликована в другом выпуске. Вы действительно хотите её добавить?')) {
                fl = 1;
            }
        }

        if (fl && catIsDisabled) {
            alert('Категория новости: отключена. Для добавления данной новости, необходимо активировать ее категорию')
            fl = 0;
        }

        if (fl) {
            $.post('/editions/addNew/', {edID: edID, newID: newID})
                  .done(function(data) {
                        $.fn.yiiGridView.update('editionsNews-grid');
                        $.fn.yiiGridView.update('news-grid');
            })
        }

    });

    $('.isRTP').live('click', function() {
        var edID = $('#Editions_intEditionID').val();
        var newPublicID = $(this).attr('intnewpublicid');
        var status =  +$(this).is(':checked');
        var catIsDisabled = $(this).closest('tr').children('td').eq(0).children('.catIsDisabled').length;

        if (status && catIsDisabled) {
            alert('Категория новости: отключена. Для одобрения данной новости, необходимо активировать ее категорию')
            return false;
        } else {
            $.post('/editions/changeStatusNewPublic/', {edID: edID, newPublicID: newPublicID, status: status})
                  .done(function(data) {
                    var result = JSON.parse(data);
                    if (0 == result.error.code) {
                        if (0 == result.data.countNotRTP) {
                            $('#publicEdition').removeClass('disabled');
                            //alert('Publish');
                        } else {
                            $('#publicEdition').addClass('disabled');
                        }
                    } else {
                        $('#publicEdition').addClass('disabled');
                    }
            })

        }
    });

    var edID = $('#Editions_intEditionID').val();
    $.post('/editions/GetCountNotRTP/', {edID: edID})
                  .done(function(data) {
                    var result = JSON.parse(data);
                    if (0 == result.error.code) {
                        if (0 == result.data.countNotRTP && ($('#editionsNews-grid td').length > 1)) {
                            $('#publicEdition').removeClass('disabled'); //Publish:
                        } else {
                            $('#publicEdition').addClass('disabled');
                        }
                    } else {
                        $('#publicEdition').addClass('disabled');
                    }
    })

    $('#refreshNewsGrid').click(function() {
        $.fn.yiiGridView.update('news-grid');
    })

    $('#publicEdition').click(function() {
        if (confirm('Вы уверены что хотите опубликовать выпуск?')) {
            $.post('/editions/public/', {edID: edID})
                  .done(function(data) {
                    var result = JSON.parse(data);
                    if (0 == result.error.code) {
                        if (1 == result.data.success) {
                            alert('Выпуск успешно опубликован!');
                            window.location='/editions/';
                        } else {
                            $('#publicEdition').addClass('disabled');
                        }
                    } else {
                        $('#publicEdition').addClass('disabled');
                        alert('Error code:'+ result.error.code);
                    }
             })
        }
    })


})
");
?>


<div class="form">
<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'editions-form',
	'enableAjaxValidation' => false,
));
?>


    <div class="row">
        <div class="col-md-2"><?php echo $form->labelEx($model,'intNumByMonth'); ?></div>
        <?php echo $form->HiddenField($model, 'intEditionID'); ?>

        <div class="col-md-10">
            <?php echo $form->textField($model, 'intNumByMonth', array( 'class' => 'form-control')); ?>
            <?php echo $form->error($model,'intNumByMonth') ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2"><?php echo $form->labelEx($model,'intMonth'); ?></div>
        <div class="col-md-10">
            <?php echo $form->textField($model, 'intMonth', array( 'class' => 'form-control')); ?>
            <?php echo $form->error($model,'intMonth') ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2"><?php echo $form->labelEx($model,'intYear'); ?></div>
        <div class="col-md-10">
            <?php echo $form->textField($model, 'intYear', array( 'class' => 'form-control', 'maxlength' => 4)); ?>
            <?php echo $form->error($model,'intYear') ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2"><?php echo $form->labelEx($model,'varMarketID'); ?></div>
        <div class="col-md-10">
            <?php echo $form->textField($model, 'varMarketID', array( 'class' => 'form-control',)); ?>
            <?php echo $form->error($model,'varMarketID') ?>
        </div>
    </div>

    <!--<div class="row">
        <div class="col-md-2"><?php /*echo $form->labelEx($model,'isPublic'); */?></div>
        <div class="col-md-10">
            <?php /*echo $form->checkBox($model, 'isPublic', array('disabled' => (Yii::app()->controller->action->id =='create' ? null : 'disabled' ), 'class' => 'form-control', 'style' => 'width:20px')); */?>
            <?php /*echo $form->error($model,'isPublic') */?>
        </div>
    </div>-->

    <div class="row">
        <div class="col-md-6">
            <h4>Доступные статьи:
                <span style="font-size: small">
                    <a id="createNew" href="/news/create" target="_blank">Создать</a>
                    <a id="refreshNewsGrid" href="#">Обновить</a>
                </span>
            </h4>

            <?php
            $this->widget('bootstrap.widgets.BsGridView', array(
                'id' => 'news-grid',
                'type' => 'striped bordered condensed',
                'dataProvider' => $modelNews->editionsSearch($model->attributes['intEditionID']),
                'template' => '{summary}{items}{pager}',
                'enablePagination' => true,
                'afterAjaxUpdate' => "js:function(id, data) {
                    $('.catIsDisabled').closest('tr').css('color','silver');

                }",
                'columns' => array(
                    array( 'name' => 'intNewID', 'header' => 'ID', 'sortable' => false, 'type' => 'raw', 'value' => function($data) {
                            return $data->intCategory->isActive ? $data->intNewID : "<span class='catIsDisabled'>" . $data->intNewID . '</span>';
                        }),
                    array( 'name' => 'varTitle', 'header' => 'Заголовок', 'sortable' => false, 'htmlOptions'=>array('style'=>'width:500px'),),
                    array( 'name' => 'intCategory', 'header' => 'Рубрика', 'sortable' => false),
                    array( 'name' => 'isFree', 'header' => 'Бесплатная', 'value' => '$data->isFree ? "Да" : "Нет"' ),
                    array( 'name' => 'isPublic', 'type' => 'raw', 'value' => function($data) {
                            return !$data->isPublic ?  "Нет" : "<span class='newIsPublic'>Да</span>";
                        }),
                    array(
                        //'name' => 'Операции',
                        'class' => 'bootstrap.widgets.BsButtonColumn',
                        'template' => '{update}',
                        'buttons' => array(
                            'update' => array(
                                'label'=>'Изменить',
                                'url'=>'"/news/update/".$data->intNewID',
                                'options'=>array('target' => '_blank'), //HTML options for the button tag.
                            ),
                        ),
                    ),
                    array(
                        'class' => 'bootstrap.widgets.BsButtonColumn',
                        'template' => '{add}',
                        'buttons' => array(
                            'add' => array(
                                'label'=>'Добавить',
                                'options'=>array('class' => 'newAdd'), //HTML options for the button tag.
                            ),
                        ),
                    ),
                ),
            ));

            ?>
        </div>
        <div class="col-md-6">
            <h4>
                Выбранные статьи:
                <span>
                    <a href="#" class="btn btn-sm btn-primary disabled" id="publicEdition">Опубликовать</a>
                </span>

            </h4>
            <?php
            $this->widget('bootstrap.widgets.BsGridView', array(
                'id' => 'editionsNews-grid',
                'type' => 'striped bordered condensed',
                'dataProvider' => $modelEditionsNews,//->search(),
                'template' => '{summary}{items}{pager}',
                'enablePagination' => true,
                'columns' => array(
                    array( 'name' => 'intNewID', 'header' => 'ID', 'sortable' => false,'type' => 'raw', 'value' => function($data) {
                            return $data->intCategory->isActive ? $data->intNewID : "<span class='catIsDisabled'>" . $data->intNewID . '</span>';
                        }),

                    array( 'name' => 'varTitle', 'header' => 'Заголовок', 'sortable' => false, 'htmlOptions'=>array('style'=>'width:500px'),),
                    array( 'name' => 'intCategory', 'header' => 'Рубрика', 'sortable' => false),
                    //array( 'name' => 'isPublic','header' => '	Опубликована', 'value' => '$data->isPublic ? "Да" : "Нет"' ),
                    array( 'name' => 'int', 'header' => 'Одобрено', 'sortable' => false,'type' => 'raw', 'value' => function($data) {
                            return "<input class='isRTP' intNewPublicID='" . $data->intNewPublicID . "' type='checkbox'" . ($data->isPublic ? 'checked' : '' ) ." />"; //$data->intCategory->isActive ? $data->intNewID : "<span class='catIsDisabled'>" . $data->intNewID . '</span>';
                        }),
                    array(
                        'class' => 'bootstrap.widgets.BsButtonColumn',
                        'template' => '{delete}',
                        'afterDelete'=>'function(link,success,data){
                           $.fn.yiiGridView.update("news-grid");
                           $(".catIsDisabled").closest("tr").css("color", "silver");
                        }',
                        'deleteConfirmation'=>"js:'Вы точно хотите удалить запись с ID '+$(this).parent().parent().children(':nth-child(2)').text()+'?'",
                        'buttons' => array(
                            'delete' => array(
                                'label'=>'Удалить',
                                'url'=>'"/newsPublic/delete/".$data->intNewPublicID',
                            ),
                        ),
                    ),
                ),
            ));

            ?>
        </div>
    </div>






    <div class="row">
        <div class="col-md-10 col-md-offset-2">
            <?php
            echo GxHtml::submitButton('Готово', array('class'=>'btn btn-sm btn-primary'));
            ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-10 col-md-offset-2" style="padding-top: 25px">
            <?php echo Yii::t('app', 'Поля, помеченные '); ?> <span class="required">*</span> <?php echo Yii::t('app', 'обязательны для заполнения');
            $this->endWidget();
            ?>.
        </div>
    </div>

</div><!-- form -->