<div class="wide form">

<?php $form = $this->beginWidget('GxActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model, 'intEditionID'); ?>
		<?php echo $form->textField($model, 'intEditionID', array('maxlength' => 10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'intNumByMonth'); ?>
		<?php echo $form->textField($model, 'intNumByMonth'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'intMonth'); ?>
		<?php echo $form->textField($model, 'intMonth'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'intYear'); ?>
		<?php echo $form->textField($model, 'intYear', array('maxlength' => 4)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'varText'); ?>
		<?php echo $form->textArea($model, 'varText'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'isPublic'); ?>
		<?php echo $form->textField($model, 'isPublic'); ?>
	</div>

	<div class="row buttons">
		<?php echo GxHtml::submitButton(Yii::t('app', 'Search')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
