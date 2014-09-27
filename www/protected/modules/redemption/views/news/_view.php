<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('intNewID')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->intNewID), array('view', 'id' => $data->intNewID)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('varText')); ?>:
	<?php echo GxHtml::encode($data->varText); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('varTitle')); ?>:
	<?php echo GxHtml::encode($data->varTitle); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('varTizer')); ?>:
	<?php echo GxHtml::encode($data->varTizer); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('varMailText')); ?>:
	<?php echo GxHtml::encode($data->varMailText); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('isFree')); ?>:
	<?php echo GxHtml::encode($data->isFree); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('isPublic')); ?>:
	<?php echo GxHtml::encode($data->isPublic); ?>
	<br />
	<?php /*
	<?php echo GxHtml::encode($data->getAttributeLabel('intCategoryID')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->intCategory)); ?>
	<br />
	*/ ?>

</div>