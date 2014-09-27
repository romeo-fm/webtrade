<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'news-comments-form',
	'enableAjaxValidation' => false,
));
?>


    <div class="row">
        <div class="col-md-2"><?php echo $form->labelEx($model,'intCommentID'); ?></div>
        <div class="col-md-10">
            <?php echo $form->textField($model, 'intCommentID', array('disabled' => 'disabled', 'class' => 'disabled form-control')); ?>
            <?php echo $form->error($model,'intCommentID') ?>
        </div>
    </div><!-- row -->

    <div class="row">
        <div class="col-md-2"><?php echo $form->labelEx($model,'intEditionID'); ?></div>
        <div class="col-md-10">
            <?php echo $form->textField($model, 'intEditionID', array('disabled' => 'disabled', 'class' => 'disabled form-control')); ?>
            <?php echo $form->error($model,'intEditionID') ?>
        </div>
    </div><!-- row -->

    <div class="row">
        <div class="col-md-2"><?php echo $form->labelEx($modelNew,'varTitle'); ?></div>
        <div class="col-md-10">
            <?php echo $form->textField($modelNew, 'varTitle', array('disabled' => 'disabled', 'class' => 'form-control')); ?>
            <?php echo $form->error($modelNew,'varTitle') ?>
        </div>
    </div><!-- row -->

    <div class="row">
        <div class="col-md-2"><?php echo $form->labelEx($model,'varName'); ?></div>
        <div class="col-md-10">
            <?php echo $form->textField($model, 'varName', array('maxlength' => 150, 'class' => 'disabled form-control')); ?>
            <?php echo $form->error($model,'varName') ?>
        </div>
    </div><!-- row -->

    <div class="row">
        <div class="col-md-2">
            <?php echo $form->labelEx($model,'isApproved'); ?>
        </div>
        <div class="col-md-10">
            <?php echo $form->dropDownList($model, 'isApproved', array('1' => 'Да', '0' => 'Нет'), array('1' => 'Да',)); ?>
            <?php echo $form->error($model,'isApproved'); ?>
        </div>
    </div><!-- row -->

    <div class="row">
        <div class="col-md-2">
            <?php echo $form->labelEx($model,'varText'); ?>
        </div>
        <div class="col-md-10">
            <?php echo $form->textArea($model, 'varText'); ?>
            <?php echo $form->error($model,'varText'); ?>
        </div>
    </div><!-- row -->


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