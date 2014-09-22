<?php

$this->breadcrumbs = array(
	NewsGallery::label(2),
);

$this->menu = array(
	array('label'=>Yii::t('app', 'Create') . ' ' . NewsGallery::label(), 'url' => array('create')),
	array('label'=>Yii::t('app', 'Manage') . ' ' . NewsGallery::label(2), 'url' => array('admin')),
);
?>

<h1><?php echo GxHtml::encode(NewsGallery::label(2)); ?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); 