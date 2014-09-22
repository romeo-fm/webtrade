<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('intEditionID')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->intEditionID), array('view', 'id' => $data->intEditionID)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('intNumByMonth')); ?>:
	<?php echo GxHtml::encode($data->intNumByMonth); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('intMonth')); ?>:
	<?php echo GxHtml::encode($data->intMonth); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('intYear')); ?>:
	<?php echo GxHtml::encode($data->intYear); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('varText')); ?>:
	<?php echo GxHtml::encode($data->varText); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('isPublic')); ?>:
	<?php echo GxHtml::encode($data->isPublic); ?>
	<br />

</div>