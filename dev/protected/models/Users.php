<?php

Yii::import('application.models._base.BaseUsers');

class Users extends BaseUsers
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}


    public function attributeLabels() {
        return array(
            'intUserID' => Yii::t('app', 'ID'),
            'isActive' => Yii::t('app', 'Активный'),
            'varPassword' => Yii::t('app', 'Пароль'),
            'varName' => Yii::t('app', 'Логин'),
            'isAdmin' => Yii::t('app', 'Гл. редактор'),
        );
    }

    public function validatePassword($password) {
        return crypt($password, $this->varPassword) === $this->varPassword;
    }

    public function hashPassword($password) {
        return crypt($password, Yii::app()->params['salt']);
    }


}