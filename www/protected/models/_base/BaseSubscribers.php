<?php

/**
 * This is the model base class for the table "subscribers".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Subscribers".
 *
 * Columns in table "subscribers" available as properties of the model,
 * and there are no model relations.
 *
 * @property string $intSubID
 * @property string $varToken
 * @property integer $varOS
 * @property string $varEmail
 *
 */
abstract class BaseSubscribers extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'subscribers';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Subscribers|Subscribers', $n);
	}

	public static function representingColumn() {
		return 'varToken';
	}

	public function rules() {
		return array(
			array('varToken, varOS, varEmail', 'required'),
			array('varOS', 'numerical', 'integerOnly'=>true),
			array('varToken', 'length', 'max'=>255),
			array('varEmail', 'length', 'max'=>50),
			array('intSubID, varToken, varOS, varEmail', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'intSubID' => Yii::t('app', 'Int Sub'),
			'varToken' => Yii::t('app', 'Var Token'),
			'varOS' => Yii::t('app', 'Var Os'),
			'varEmail' => Yii::t('app', 'Var Email'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('intSubID', $this->intSubID, true);
		$criteria->compare('varToken', $this->varToken, true);
		$criteria->compare('varOS', $this->varOS);
		$criteria->compare('varEmail', $this->varEmail, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}