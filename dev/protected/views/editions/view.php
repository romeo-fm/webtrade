<?php

$this->breadcrumbs = array(
    $model->label(2) => array('index'),
    Yii::t('app', 'Просмотр'),
);
?>

    <div class="row">
        <div class="col-md-2">
            <a id="goBackNotConfirm" href="#" class="btn btn-primary"><span class="glyphicon glyphicon-hand-left"></span> Вернуться</a>
        </div>

    </div>

<?php
Yii::app()->clientScript->registerScript('search', "
$(document).ready(function(){
    $('.catIsDisabled').closest('tr').css('color','silver');
    $('span.required').hide();
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
        <div class="col-md-2"><?php echo $form->labelEx($model, 'varMarketID'); ?></div>
        <div class="col-md-10">
            <?php echo $form->textField($model, 'varMarketID', array( 'class' => 'form-control', )); ?>
            <?php echo $form->error($model, 'varMarketID') ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h4>
                Выбранные статьи:

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
                            return $data->isPublic ? 'Да' : 'Нет';
                        }),
                ),
            ));

            ?>
        </div>

        <div class="col-md-6">
        </div>
    </div>

    <div class="row">
        <div class="col-md-10 col-md-offset-2" style="padding-top: 25px">
            <?php $this->endWidget(); ?>.
        </div>
    </div>

</div><!-- form -->