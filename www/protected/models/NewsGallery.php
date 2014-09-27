<?php

Yii::import('application.models._base.BaseNewsGallery');

class NewsGallery extends BaseNewsGallery
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}