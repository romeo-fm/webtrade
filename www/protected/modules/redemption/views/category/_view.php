<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('intCategoryID')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->intCategoryID), array('view', 'id' => $data->intCategoryID)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('varTitle')); ?>:
	<?php echo GxHtml::encode($data->varTitle); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('isActive')); ?>:
	<?php echo GxHtml::encode($data->isActive); ?>
	<br />

</div>