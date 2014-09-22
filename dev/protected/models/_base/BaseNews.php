<?php

/**
 * This is the model base class for the table "news".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "News".
 *
 * Columns in table "news" available as properties of the model,
 * followed by relations of table "news" available as properties of the model.
 *
 * @property string $intNewID
 * @property string $varText
 * @property string $varTitle
 * @property string $varTizer
 * @property string $varMailText
 * @property integer $isFree
 * @property integer $isPublic
 * @property string $intCategoryID
 *
 * @property Category $intCategory
 * @property NewsGallery[] $newsGalleries
 */
abstract class BaseNews extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'news';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'News|News', $n);
	}

	public static function representingColumn() {
		return 'varText';
	}

	public function rules() {
		return array(
			array('varText, varTitle, varTizer, varMailText, intCategoryID', 'required'),
			array('isFree, isPublic', 'numerical', 'integerOnly'=>true),
			array('varTitle, varTizer', 'length', 'max'=>255),
			array('intCategoryID', 'length', 'max'=>10),
			array('isFree, isPublic', 'default', 'setOnEmpty' => true, 'value' => null),
			array('intNewID, varText, varTitle, varTizer, varMailText, isFree, isPublic, intCategoryID', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'intCategory' => array(self::BELONGS_TO, 'Category', 'intCategoryID'),
			'newsGalleries' => array(self::HAS_MANY, 'NewsGallery', 'intNewID'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'intNewID' => Yii::t('app', 'Int New'),
			'varText' => Yii::t('app', 'Var Text'),
			'varTitle' => Yii::t('app', 'Var Title'),
			'varTizer' => Yii::t('app', 'Var Tizer'),
			'varMailText' => Yii::t('app', 'Var Mail Text'),
			'isFree' => Yii::t('app', 'Is Free'),
			'isPublic' => Yii::t('app', 'Is Public'),
			'intCategoryID' => null,
			'intCategory' => null,
			'newsGalleries' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('intNewID', $this->intNewID, true);
		$criteria->compare('varText', $this->varText, true);
		$criteria->compare('varTitle', $this->varTitle, true);
		$criteria->compare('varTizer', $this->varTizer, true);
		$criteria->compare('varMailText', $this->varMailText, true);
		$criteria->compare('isFree', $this->isFree);
		$criteria->compare('isPublic', $this->isPublic);
		$criteria->compare('intCategoryID', $this->intCategoryID);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}