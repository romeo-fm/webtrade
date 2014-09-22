<?php

$this->breadcrumbs = array(
	NewsRating::label(2) => array('index'),
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
$(document).ready(function(){
    $('select').addClass('form-control').css('width','100px').css('display','inline');
})
");
?>


<div class="row">
    <div class="col-md-8" style="margin: 20px">
                <div class="search-form">
                    <?php $this->renderPartial('_search', array(
                        'model' => $model,
                    )); ?>
                </div><!-- search-form -->
    </div>
</div>
<?php

$this->widget('bootstrap.widgets.BsGridView', array(
    'id' => 'news-rating-grid',
    'type' => 'striped bordered condensed',
    'dataProvider' => $model->search(),
   // 'filter' => $model,
    'template' => '{summary}{items}{pager}',
    'enablePagination' => true,
    'columns' => array(
        array( 'name' => 'intEditionID', 'sortable' => false ),
        array( 'name' => 'intNew.varTitle', 'sortable' => false ),
        array( 'name' => 'category', 'value' => '$data->category', 'header' => 'Категория'),
        array( 'name' => 'rating', 'value' => '$data->rating', 'header' => 'Рейтинг', 'sortable' =>true),
        array( 'name' => 'intLikes', 'header' => 'Нравится' ),
        array( 'name' => 'intDisLikes', 'header' => 'Не нравится' ),
    ),
));

