<?php

$this->breadcrumbs = array(
    $model->label(2) => array('index'),
    GxHtml::valueEx($model),
);

?>

<h1><?php echo Yii::t('app', 'View') . ' ' . GxHtml::encode($model->label()) . ' ' . GxHtml::encode(GxHtml::valueEx($model)); ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'intNewID',
        'varText',
        'varTitle',
        'varTizer',
        'varMailText',
        'isFree',
        'isPublic',
        array(
            'name' => 'intCategory',
            'type' => 'raw',
            'value' => $model->intCategory !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->intCategory)), array('category/view', 'id' => GxActiveRecord::extractPkValue($model->intCategory, true))) : null,
        ),
    ),
)); ?>

<h2><?php echo GxHtml::encode($model->getRelationLabel('newsGalleries')); ?></h2>
<?php
echo GxHtml::openTag('ul');
foreach($model->newsGalleries as $relatedModel) {
    echo GxHtml::openTag('li');
    echo GxHtml::link(GxHtml::encode(GxHtml::valueEx($relatedModel)), array('newsGallery/view', 'id' => GxActiveRecord::extractPkValue($relatedModel, true)));
    echo GxHtml::closeTag('li');
}
echo GxHtml::closeTag('ul');
?> 