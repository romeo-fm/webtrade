<?php

Yii::import('application.models._base.BaseNewsPublicGallery');

class NewsPublicGallery extends BaseNewsPublicGallery
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}