<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'users-form',
	'enableAjaxValidation' => false,
));
?>

    <div class="row">
        <div class="col-md-2">
            <a id="goBack" href="#" class="btn btn-primary"><span class="glyphicon glyphicon-hand-left"></span> Вернуться</a>
        </div>
    </div>


    <div class="row">
        <div class="col-md-2">
            <?php echo $form->labelEx($model,'isActive'); ?>
        </div>
        <div class="col-md-10">
            <?php echo $form->dropDownList($model, 'isActive', array('1' => 'Да', '0' => 'Нет')); ?>
            <?php echo $form->error($model,'isActive'); ?>
        </div>
    </div><!-- row -->

    <div class="row">
        <div class="col-md-2"><?php echo $form->labelEx($model,'varName'); ?></div>
        <div class="col-md-10">
            <?php echo $form->textField($model, 'varName', array('maxlength' => 255, 'class' => 'form-control')); ?>
            <?php echo $form->error($model,'varName') ?>
        </div>
    </div><!-- row -->


    <div class="row">
        <div class="col-md-2"><?php echo $form->labelEx($model,'varPassword'); ?></div>
        <div class="col-md-10">
            <?php echo $form->textField($model, 'varPassword', array('maxlength' => 255, 'value'=>'', 'class' => 'form-control')); ?>
            <?php echo $form->error($model,'varPassword') ?>
        </div>
    </div><!-- row -->


    <div class="row">
        <div class="col-md-2">
            <?php echo $form->labelEx($model,'isAdmin'); ?>
        </div>
        <div class="col-md-10">
            <?php echo $form->dropDownList($model, 'isAdmin', array('1' => 'Да', '0' => 'Нет'), array('1' => 'Да',)); ?>
            <?php echo $form->error($model,'isAdmin'); ?>
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
            <?php echo Yii::t('app', 'Поля, помеченные '); ?> <span class="required">*</span> <?php echo Yii::t('app', 'обязательны для заполнения.');
            $this->endWidget();
            ?>.
        </div>
    </div>

</div><!-- form -->