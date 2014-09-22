<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'news-rating-form',
	'enableAjaxValidation' => false,
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->labelEx($model,'intEditionID'); ?>
		<?php echo $form->dropDownList($model, 'intEditionID', GxHtml::listDataEx(Editions::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model,'intEditionID'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'intNewID'); ?>
		<?php echo $form->dropDownList($model, 'intNewID', GxHtml::listDataEx(News::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model,'intNewID'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'intLikes'); ?>
		<?php echo $form->textField($model, 'intLikes', array('maxlength' => 10)); ?>
		<?php echo $form->error($model,'intLikes'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'intDisLikes'); ?>
		<?php echo $form->textField($model, 'intDisLikes', array('maxlength' => 10)); ?>
		<?php echo $form->error($model,'intDisLikes'); ?>
		</div><!-- row -->


<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'));
$this->endWidget();
?>
</div><!-- form -->