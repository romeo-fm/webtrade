<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('intUserID')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->intUserID), array('view', 'id' => $data->intUserID)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('isActive')); ?>:
	<?php echo GxHtml::encode($data->isActive); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('varPassword')); ?>:
	<?php echo GxHtml::encode($data->varPassword); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('varName')); ?>:
	<?php echo GxHtml::encode($data->varName); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('isAdmin')); ?>:
	<?php echo GxHtml::encode($data->isAdmin); ?>
	<br />

</div>