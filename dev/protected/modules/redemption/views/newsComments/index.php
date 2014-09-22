<?php

$this->breadcrumbs = array(
    $model->label(2) => array('index'),
);

Yii::app()->clientScript->registerScript('search', "
$(document).ready(function(){
    $('.button-column').eq(0).text('Действия').css('width','120px');

    function beforeUpdate() {
        $('td').each(function() {
              if ($(this).text() == 'Да') {
                $(this).closest('tr').css('color','silver')
              }
        })

         $('.isActive').each(function() {
                  if ($(this).text() == 'Да') {
                    $(this).append(' | <button class=\"btn btn-xs btn-default comActive\">Деактивировать</button>');
                  } else {
                    $(this).append(' | <button class=\"btn btn-xs btn-primary comNotActive\">Активировать</button>');
                  }
        })
    }

    function updateActive() {
            setTimeout( function() {
                $('.comActive').closest('tr').css('color','silver');
                $('.comNotActive').closest('tr').css('color','black');
            }, 100)


    }

    beforeUpdate();
    updateActive();

    $('.comActive, .comNotActive').live('click', updateActive);

    // Deactivate:
    $('button.comActive').live('click', function() {
        var id = $(this).closest('tr').children('td').eq(0).text();
        $(this).closest('td').html('Нет | <button class=\"btn btn-xs btn-primary comNotActive\">Активировать</button>');
        $(this).append(' | <button class=\"btn btn-xs btn-default comActive\">Деактивировать</button>');
                    $.ajax({
                        url: '/newsComments/deactivate',
                        type: 'POST',
                        cache: false,
                        data: {id: id, status: 0},
                        dataType: 'json'
                    })
    })

    // activate:
    $('button.comNotActive').live('click', function() {
        var id = $(this).closest('tr').children('td').eq(0).text();
        $(this).closest('td').html('Да | <button class=\"btn btn-xs btn-default comActive\">Деактивировать</button>');
            $(this).append(' | <button class=\"btn btn-xs btn-default comActive\">Деактивировать</button>');
                $.ajax({
                    url: '/newsComments/deactivate',
                    type: 'POST',
                    cache: false,
                    data: {id: id, status: 1},
                    dataType: 'json'
                });
    })

    $('#countNewComment').attr('lastID'," . $lastCommentID . ");

    setInterval(function(){
      $.post('/newsComments/checkcomments', {lastID: $('#countNewComment').attr('lastID')})
          .done(function(data) {
            if (parseInt(data) > 0) {
                $('#countNewComment').text(\"(\" + data + \")\");
            }
          })
    },30000);


    // trim length comments and title:
    $('.comment').each(function(){
          $(this).data('text', $(this).text());

          var endSymbol = '';
          if ($(this).text().length >= 80) {
            endSymbol = '...';
          }
          $(this).text($(this).text().substr(0,80) + endSymbol)
    })

    $('.title').each(function(){
          $(this).data('title', $(this).text());

          var endSymbol = '';
          if ($(this).text().length >= 80) {
            endSymbol = '...';
          }
          $(this).text($(this).text().substr(0,80) + endSymbol)
    })


    $('.comment').live({
        mouseenter: function () {
          $(this).text($(this).data('text'));
        },
        mouseleave: function () {
          var endSymbol = '';
          if ($(this).text().length >= 80) {
            endSymbol = '...';
          }
          $(this).text($(this).text().substr(0,80) + endSymbol) ;
        }
    });

    $('.title').live({
        mouseenter: function () {
          $(this).text($(this).data('title'));
        },
        mouseleave: function () {
          var endSymbol = '';
          if ($(this).text().length >= 80) {
            endSymbol = '...';
          }
          $(this).text($(this).text().substr(0,80) + endSymbol) ;
        }
    });
    // end trim

})
");
?>
    <div class="row" id="statusMsg" style="display: none">
        <div class="col-md-12" style="margin: 20px;padding-right: 50px">
            <div>
                <a href="#" class="btn btn-block btn-sm btn-info">
                    <span class="glyphicon glyphicon-check"></span> Элемент успешно удален</a>
            </div>
        </div>
    </div>

<?php

$this->widget('bootstrap.widgets.BsGridView', array(
    'id' => 'news-comments-grid',
    'type' => 'striped bordered condensed',
    'dataProvider' => $model->search(),
    'template' => '{summary}{items}{pager}',
    'enablePagination' => true,
    'afterAjaxUpdate' => 'js:function(id, data) {
                    $(".button-column").eq(0).text("Действия").css("width","120px")
                    function beforeUpdate() {
                        $("td").each(function() {
                              if ($(this).text() == "Да") {
                                $(this).closest("tr").css("color","silver")
                              }
                        })
                         $(".isActive").each(function() {
                                  if ($(this).text() == "Да") {
                                    $(this).append(" | <button class=\"btn btn-xs btn-default comActive\">Деактивировать</button>");
                                  } else {
                                    $(this).append(" | <button class=\"btn btn-xs btn-primary comNotActive\">Активировать</button>");
                                  }
                        })
                    }

                    function updateActive() {
                            setTimeout( function() {
                                $(".comActive").closest("tr").css("color","silver");
                                $(".comNotActive").closest("tr").css("color","black");
                            }, 100)


                    }

                    beforeUpdate();
                    updateActive();

                    // trim length comments and title:
                    $(".comment").each(function(){
                         $(this).data("text", $(this).text());
                        var endSymbol = "";
                        if ($(this).text().length >= 80) {
                            endSymbol = "...";
                        }
                          $(this).text($(this).text().substr(0,80) + endSymbol)
                    })

                     $(".title").each(function(){
                         $(this).data("title", $(this).text());
                        var endSymbol = "";
                        if ($(this).text().length >= 80) {
                            endSymbol = "...";
                        }
                          $(this).text($(this).text().substr(0,80) + endSymbol)
                    })
    }',
    'columns' => array(
        array(
            'name'=>'ID',
            'value'=>'$data->intCommentID',
            'sortable' => false,
            'htmlOptions'=>array('style'=>'width:35px'),
        ),
        array(
            'name'=>'Выпуск',
            'value'=>'GxHtml::valueEx($data->intEdition)',
            'filter'=>GxHtml::listDataEx(Editions::model()->findAllAttributes(null, true)),
            'sortable' => false,
            'htmlOptions'=>array('style'=>'width:80px'),
        ),
        array(
            'name'=>'Статья',
            'value'=>'$data->intNewPublic->varTitle',
            'sortable' => false,
            'htmlOptions'=>array('style'=>'width:250px', 'class'=>'title'),
        ),

        array(
            'name'=>'varName',
            'value'=>'$data->varName',
            'sortable' => false,
            'htmlOptions'=>array('style'=>'width:120px'),
        ),
        array(
            'name'=>'varText',
            'value'=>'$data->varText',
            'sortable' => false,
            'htmlOptions'=>array('class'=>'comment'),
        ),
        array(
            'name' => 'isApproved',
            'value' => '$data->isApproved ? "Да" : "Нет"',
            'sortable' => false,
            'htmlOptions'=>array('style'=>'width:150px', 'class' => 'isActive'),
        ),

        //array( 'name' => 'isActive', 'header' => 'Статус', 'value' => '$data->isActive ? "Да" : "Нет"' , 'sortable' => false,),
        array(
            //'name' => 'Операции',
            //'class' => 'CButtonColumn',
            'class' => 'bootstrap.widgets.BsButtonColumn',
            'template' => '{update} {delete}',
            'deleteConfirmation'=>"js:'Вы точно хотите удалить запись с ID '+$(this).parent().parent().children(':nth-child(2)').text()+'?'",
            'afterDelete'=>'function(link,success,data){
                if (success) {
                    $("#statusMsg").toggle();
                }
            }',
            'buttons' => array(
                'delete' => array(
                    'label'=>'Удалить',
                ),
                'update' => array(
                    'label'=>'Изменить',
                ),
            ),

            //'template' => '{view} {update} {delete}',
        ),
        //array('class' => 'bootstrap.widgets.BsButtonColumn', 'template' => '{delete}' ),

    ),
));
