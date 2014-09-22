<div class="wide form" style="margin: 10px 0 20px 0">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'enableAjaxValidation'=>false,
    ));
    ?>
    <div class="row">

        <?php echo $form->label($model, 'intEditionID'); ?>
        <?php echo $form->textField($model, 'intEditionID', array('maxlength' => 10, 'class' => 'form-control', 'style' => 'width:100px;display:inline;')); ?>

        <?php  echo $form->label($model, 'intCategoryID'); ?>
        <?php  echo $form->dropDownList($model,
            'intCategoryID',
            GxHtml::listDataEx(Category::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All')));
        ?>

        <?php echo CHTML::submitButton('Искать', array('class'=>'btn btn-primary btn-sm')); ?>

        <a class="btn btn-primary btn-sm" href="/newsRating" style="">Сбросить фильтр</a>

    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->
