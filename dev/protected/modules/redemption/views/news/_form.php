<div class="form">


    <?php $form = $this->beginWidget('GxActiveForm', array(
        'id' => 'news-form',
        'enableAjaxValidation' => false,
    ));
    ?>

    <div class="row">
        <div class="col-md-2">
            <a id="goBack" href="#" class="btn btn-primary"><span class="glyphicon glyphicon-hand-left"></span> Вернуться</a>
        </div>

    </div>

    <div class="row">
        <?php echo $form->errorSummary($model); ?>
        <?php echo $form->hiddenField($model, 'isPublic'); ?>
        <?php echo $form->error($model,'isPublic'); ?>
    </div>


    <div class="row">
        <div class="col-md-2"><?php echo $form->labelEx($model,'varTitle'); ?></div>
        <div class="col-md-10">
            <?php echo $form->textField($model, 'varTitle', array('maxlength' => 255, 'class' => 'form-control')); ?>
            <?php echo $form->error($model,'varTitle') ?>
        </div>
    </div><!-- row -->

    <div class="row">
        <div class="col-md-2">
            <?php echo $form->labelEx($model,'varTizer'); ?>
        </div>
            <div class="col-md-10" style="width: 999px">
                <?php $this->widget('application.extensions.ckeditor.CKEditor', array(
                    'model'=>$model,
                    'attribute'=>'varTizer',
                    'language'=>'ru',
                    'editorTemplate'=>'advanced',
                    'toolbar'=>array(
                        array('Source','-','Undo','Redo', '-', 'Bold', 'Italic', '-', 'BulletedList', '-', 'Link', 'Unlink','Table', '-' ,'Maximize',)
                    ),
                )); ?>
                <?php echo $form->error($model,'varTizer'); ?>
            </div>
    </div><!-- row -->

    <div class="row">
        <div class="col-md-2"><?php echo $form->labelEx($model,'varText'); ?></div>
        <div class="col-md-10"  style="width: 999px">
            <?php $this->widget('application.extensions.ckeditor.CKEditor', array(
                'model'=>$model,
                'attribute'=>'varText',
                'language'=>'ru',
                'editorTemplate'=>'advanced',
                'toolbar'=>array(
                    array('Source','-','Undo','Redo', '-', 'Bold', 'Italic', '-', 'BulletedList', '-', 'Link', 'Unlink','Table', '-' ,'Maximize',)
                ),
                //'editorTemplate'=>'basic',
                //'editorTemplate'=>'full',
            )); ?>

            <?php echo $form->error($model,'varText'); ?>
        </div>
    </div><!-- row -->

    <div class="row">
        <div class="col-md-2">
            <?php echo $form->labelEx($model,'varMailText'); ?>
        </div>
        <div class="col-md-10" style="width: 999px">
            <?php $this->widget('application.extensions.ckeditor.CKEditor', array(
                'model'=>$model,
                'attribute'=>'varMailText',
                'language'=>'ru',
                'editorTemplate'=>'advanced',
                'toolbar'=>array(
                    array('Source','-','Undo','Redo', '-', 'Bold', 'Italic', '-', 'BulletedList', '-', 'Link', 'Unlink','Table', '-' ,'Maximize',)
                ),
            )); ?>
            <?php echo $form->error($model,'varMailText'); ?>
        </div>
    </div><!-- row -->

    <div class="row">
        <div class="col-md-2">
            <?php echo $form->labelEx($model,'isFree'); ?>
        </div>
        <div class="col-md-10">
            <?php echo $form->dropDownList($model, 'isFree', array('1' => 'Да', '0' => 'Нет')); ?>
            <?php echo $form->error($model,'isFree'); ?>
        </div>
    </div><!-- row -->

    <div class="row">
        <div class="col-md-2">
            <?php echo $form->labelEx($model,'intCategoryID'); ?>
        </div>
        <div class="col-md-10">
            <?php echo $form->dropDownList($model, 'intCategoryID', GxHtml::listDataEx(Category::model()->findAllByAttributes(array('isActive'=>1)))); ?>
            <?php echo $form->error($model,'intCategoryID'); ?>
        </div>
    </div><!-- row -->

    <div class="row">
        <div class="col-md-2">
            <label><?php echo GxHtml::encode($model->getRelationLabel('newsGalleries')); ?>:</label>
        </div>
        <div class="col-md-10">
            <?php
            if ( $model->galleryBehavior->getGallery() === null ) {
                echo '<p>Перед добавлением фото в галерею, сохраните статью</p>';
            } else {
                $this->widget('ext.galleryManager.GalleryManager', array(
                    'gallery' => $model->galleryBehavior->getGallery(),
                    'controllerRoute' => '/gallery',
                ));
            }
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
            <?php echo Yii::t('app', 'Поля, помеченные '); ?> <span class="required">*</span> <?php echo Yii::t('app', 'обязательны для заполнения.');
            $this->endWidget();
            ?>.
        </div>
    </div>

</div><!-- form --> 