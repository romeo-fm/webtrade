<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	GxHtml::valueEx($model),
);

$this->menu=array(
	array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('index')),
	array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('create')),
	array('label'=>Yii::t('app', 'Update') . ' ' . $model->label(), 'url'=>array('update', 'id' => $model->intRatingID)),
	array('label'=>Yii::t('app', 'Delete') . ' ' . $model->label(), 'url'=>'#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->intRatingID), 'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app', 'View') . ' ' . GxHtml::encode($model->label()) . ' ' . GxHtml::encode(GxHtml::valueEx($model)); ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data' => $model,
	'attributes' => array(
'intRatingID',
array(
			'name' => 'intEdition',
			'type' => 'raw',
			'value' => $model->intEdition !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->intEdition)), array('editions/view', 'id' => GxActiveRecord::extractPkValue($model->intEdition, true))) : null,
			),
array(
			'name' => 'intNew',
			'type' => 'raw',
			'value' => $model->intNew !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->intNew)), array('news/view', 'id' => GxActiveRecord::extractPkValue($model->intNew, true))) : null,
			),
'intLikes',
'intDisLikes',
	),
)); ?>

