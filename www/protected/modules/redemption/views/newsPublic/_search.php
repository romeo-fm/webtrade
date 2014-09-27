<div class="wide form">

<?php $form = $this->beginWidget('GxActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model, 'intNewPublicID'); ?>
		<?php echo $form->textField($model, 'intNewPublicID', array('maxlength' => 10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'intNewID'); ?>
		<?php echo $form->textField($model, 'intNewID', array('maxlength' => 10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'varText'); ?>
		<?php echo $form->textArea($model, 'varText'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'varTitle'); ?>
		<?php echo $form->textField($model, 'varTitle', array('maxlength' => 255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'varTizer'); ?>
		<?php echo $form->textField($model, 'varTizer', array('maxlength' => 255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'varMailText'); ?>
		<?php echo $form->textArea($model, 'varMailText'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'isFree'); ?>
		<?php echo $form->textField($model, 'isFree'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'isPublic'); ?>
		<?php echo $form->textField($model, 'isPublic'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'intCategoryID'); ?>
		<?php echo $form->dropDownList($model, 'intCategoryID', GxHtml::listDataEx(Category::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row buttons">
		<?php echo GxHtml::submitButton(Yii::t('app', 'Search')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
