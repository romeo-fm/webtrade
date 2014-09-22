<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'news-public-form',
	'enableAjaxValidation' => false,
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->labelEx($model,'intNewID'); ?>
		<?php echo $form->textField($model, 'intNewID', array('maxlength' => 10)); ?>
		<?php echo $form->error($model,'intNewID'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'varText'); ?>
		<?php echo $form->textArea($model, 'varText'); ?>
		<?php echo $form->error($model,'varText'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'varTitle'); ?>
		<?php echo $form->textField($model, 'varTitle', array('maxlength' => 255)); ?>
		<?php echo $form->error($model,'varTitle'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'varTizer'); ?>
		<?php echo $form->textField($model, 'varTizer', array('maxlength' => 255)); ?>
		<?php echo $form->error($model,'varTizer'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'varMailText'); ?>
		<?php echo $form->textArea($model, 'varMailText'); ?>
		<?php echo $form->error($model,'varMailText'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'isFree'); ?>
		<?php echo $form->textField($model, 'isFree'); ?>
		<?php echo $form->error($model,'isFree'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'isPublic'); ?>
		<?php echo $form->textField($model, 'isPublic'); ?>
		<?php echo $form->error($model,'isPublic'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'intCategoryID'); ?>
		<?php echo $form->dropDownList($model, 'intCategoryID', GxHtml::listDataEx(Category::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model,'intCategoryID'); ?>
		</div><!-- row -->

		<label><?php echo GxHtml::encode($model->getRelationLabel('editionsItems')); ?></label>
		<?php echo $form->checkBoxList($model, 'editionsItems', GxHtml::encodeEx(GxHtml::listDataEx(EditionsItems::model()->findAllAttributes(null, true)), false, true)); ?>
		<label><?php echo GxHtml::encode($model->getRelationLabel('newsComments')); ?></label>
		<?php echo $form->checkBoxList($model, 'newsComments', GxHtml::encodeEx(GxHtml::listDataEx(NewsComments::model()->findAllAttributes(null, true)), false, true)); ?>
		<label><?php echo GxHtml::encode($model->getRelationLabel('newsPublicGalleries')); ?></label>
		<?php echo $form->checkBoxList($model, 'newsPublicGalleries', GxHtml::encodeEx(GxHtml::listDataEx(NewsPublicGallery::model()->findAllAttributes(null, true)), false, true)); ?>
		<label><?php echo GxHtml::encode($model->getRelationLabel('newsRatings')); ?></label>
		<?php echo $form->checkBoxList($model, 'newsRatings', GxHtml::encodeEx(GxHtml::listDataEx(NewsRating::model()->findAllAttributes(null, true)), false, true)); ?>

<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'));
$this->endWidget();
?>
</div><!-- form -->