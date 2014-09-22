<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('intPhotoID')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->intPhotoID), array('view', 'id' => $data->intPhotoID)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('intNewID')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->intNew)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('name')); ?>:
	<?php echo GxHtml::encode($data->name); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('varHash')); ?>:
	<?php echo GxHtml::encode($data->varHash); ?>
	<br />

</div>