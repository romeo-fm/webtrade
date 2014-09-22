<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	Yii::t('app', 'Manage'),
);


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('news-rating-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('app', 'Manage') . ' ' . GxHtml::encode($model->label(2)); ?></h1>

<p>
You may optionally enter a comparison operator (&lt;, &lt;=, &gt;, &gt;=, &lt;&gt; or =) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo GxHtml::link(Yii::t('app', 'Advanced Search'), '#', array('class' => 'search-button')); ?>
<div class="search-form">
<?php $this->renderPartial('_search', array(
	'model' => $model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'news-rating-grid',
	'dataProvider' => $model->search(),
	'filter' => $model,
	'columns' => array(
		'intRatingID',
		array(
				'name'=>'intEditionID',
				'value'=>'GxHtml::valueEx($data->intEdition)',
				'filter'=>GxHtml::listDataEx(Editions::model()->findAllAttributes(null, true)),
				),
		array(
				'name'=>'intNewID',
				'value'=>'GxHtml::valueEx($data->intNew)',
				'filter'=>GxHtml::listDataEx(News::model()->findAllAttributes(null, true)),
				),
		'intLikes',
		'intDisLikes',
		array(
			'class' => 'CButtonColumn',
		),
	),
)); ?>