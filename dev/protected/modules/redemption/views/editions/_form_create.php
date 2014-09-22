<?php
Yii::app()->clientScript->registerScript('search', "
$(document).ready(function(){
    $('.newAdd').live('click', function() {
        console.log(this);
        console.log('clicked');
        //return false;

        //  TODO: add edit/newID
        $.post('/editions/addNew/', {lastID: $('#countNewComment').attr('lastID')})
              .done(function(data) {
                if (parseInt(data) > 0) {
                    $('#countNewComment').text(\"(\" + data + \")\");
                }
        })
        return false;
    });
})
");
?>


<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'editions-form',
	'enableAjaxValidation' => false,
));
?>

	<?php echo $form->errorSummary($model); ?>

    <div class="row">
        <div class="col-md-2"><?php echo $form->labelEx($model,'intNumByMonth'); ?></div>
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