<div class="wide form">

    <div class="row">
        <?php $form = $this->beginWidget('CActiveForm', array(
            'action' => Yii::app()->createUrl($this->route),
            'method' => 'get',
            'enableAjaxValidation'=>false,
        )); ?>

        <?php echo $form->label($model, 'varTitle'); ?>
        <?php echo $form->textField($model, 'varTitle', array('maxlength' => 255, 'class' => 'form-control', 'style' => 'width:300px;display:inline;margin: 0 8px')); ?>

        <?php echo $form->label($model, 'isFree'); ?>
        <?php echo $form->dropDownList($model, 'isFree', array('1' => 'Да', '0' => 'Нет'), array('prompt' => Yii::t('app', 'All'))); ?>

        <?php echo $form->label($model, 'isPublic'); ?>
        <?php echo $form->dropDownList($model, 'isPublic', array('1' => 'Да', '0' => 'Нет'), array('prompt' => Yii::t('app', 'All'))) ?>

        <?php echo $form->label($model, 'intCategoryID'); ?>
        <?php echo $form->dropDownList($model, 'intCategoryID',
                            GxHtml::listDataEx(Category::model()->findAllByAttributes(array('isActive'=>1))),
                            array('prompt' => Yii::t('app', 'All')));
        ?>

        <?php echo CHTML::submitButton('Искать', array('class'=>'btn btn-primary btn-sm', 'style' => 'width:60px')); ?>
        <a class="btn btn-primary btn-sm" href="/news" style="">Сбросить фильтр</a>

        <?php $this->endWidget(); ?>
    </div>
</div><!-- search-form -->
