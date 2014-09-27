<?php

/**
 * This is the model base class for the table "news_public_gallery".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "NewsPublicGallery".
 *
 * Columns in table "news_public_gallery" available as properties of the model,
 * followed by relations of table "news_public_gallery" available as properties of the model.
 *
 * @property string $intPhotoID
 * @property string $intNewPublicID
 * @property string $name
 * @property string $varHash
 *
 * @property NewsPublic $intNewPublic
 */
abstract class BaseNewsPublicGallery extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'news_public_gallery';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'NewsPublicGallery|NewsPublicGalleries', $n);
	}

	public static function representingColumn() {
		return 'name';
	}

	public function rules() {
		return array(
			array('intNewPublicID, name', 'required'),
			array('intNewPublicID', 'length', 'max'=>10),
			array('name', 'length', 'max'=>50),
			array('varHash', 'length', 'max'=>32),
			array('varHash', 'default', 'setOnEmpty' => true, 'value' => null),
			array('intPhotoID, intNewPublicID, name, varHash', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'intNewPublic' => array(self::BELONGS_TO, 'NewsPublic', 'intNewPublicID'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'intPhotoID' => Yii::t('app', 'Int Photo'),
			'intNewPublicID' => null,
			'name' => Yii::t('app', 'Name'),
			'varHash' => Yii::t('app', 'Var Hash'),
			'intNewPublic' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('intPhotoID', $this->intPhotoID, true);
		$criteria->compare('intNewPublicID', $this->intNewPublicID);
		$criteria->compare('name', $this->name, true);
		$criteria->compare('varHash', $this->varHash, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}