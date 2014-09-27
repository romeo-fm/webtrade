<?php

Yii::import('application.models._base.BaseSubscribers');

class Subscribers extends BaseSubscribers
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}