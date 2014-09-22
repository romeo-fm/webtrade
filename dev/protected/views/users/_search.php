<div class="wide form">

<?php $form = $this->beginWidget('GxActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model, 'intUserID'); ?>
		<?php echo $form->textField($model, 'intUserID', array('maxlength' => 10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'isActive'); ?>
		<?php echo $form->textField($model, 'isActive'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'varPassword'); ?>
		<?php echo $form->textField($model, 'varPassword', array('maxlength' => 32)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'varName'); ?>
		<?php echo $form->textField($model, 'varName', array('maxlength' => 150)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'isAdmin'); ?>
		<?php echo $form->textField($model, 'isAdmin'); ?>
	</div>

	<div class="row buttons">
		<?php echo GxHtml::submitButton(Yii::t('app', 'Search')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
