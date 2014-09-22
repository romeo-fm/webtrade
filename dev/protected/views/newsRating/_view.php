<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('intRatingID')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->intRatingID), array('view', 'id' => $data->intRatingID)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('intEditionID')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->intEdition)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('intNewID')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->intNew)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('intLikes')); ?>:
	<?php echo GxHtml::encode($data->intLikes); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('intDisLikes')); ?>:
	<?php echo GxHtml::encode($data->intDisLikes); ?>
	<br />

</div>