<?php

/**
 * This is the model base class for the table "news_comments".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "NewsComments".
 *
 * Columns in table "news_comments" available as properties of the model,
 * followed by relations of table "news_comments" available as properties of the model.
 *
 * @property string $intCommentID
 * @property string $intEditionID
 * @property string $intNewPublicID
 * @property string $varName
 * @property integer $isApproved
 * @property string $varText
 *
 * @property NewsPublic $intNewPublic
 * @property Editions $intEdition
 */
abstract class BaseNewsComments extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'news_comments';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'NewsComments|NewsComments', $n);
	}

	public static function representingColumn() {
		return 'varName';
	}

	public function rules() {
		return array(
			array('intEditionID, intNewPublicID, varName', 'required'),
			array('isApproved', 'numerical', 'integerOnly'=>true),
			array('intEditionID, intNewPublicID', 'length', 'max'=>10),
			array('varName', 'length', 'max'=>150),
			array('varText', 'safe'),
			array('isApproved, varText', 'default', 'setOnEmpty' => true, 'value' => null),
			array('intCommentID, intEditionID, intNewPublicID, varName, isApproved, varText', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'intNewPublic' => array(self::BELONGS_TO, 'NewsPublic', 'intNewPublicID'),
			'intEdition' => array(self::BELONGS_TO, 'Editions', 'intEditionID'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'intCommentID' => Yii::t('app', 'Int Comment'),
			'intEditionID' => null,
			'intNewPublicID' => null,
			'varName' => Yii::t('app', 'Var Name'),
			'isApproved' => Yii::t('app', 'Is Approved'),
			'varText' => Yii::t('app', 'Var Text'),
			'intNewPublic' => null,
			'intEdition' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('intCommentID', $this->intCommentID, true);
		$criteria->compare('intEditionID', $this->intEditionID);
		$criteria->compare('intNewPublicID', $this->intNewPublicID);
		$criteria->compare('varName', $this->varName, true);
		$criteria->compare('isApproved', $this->isApproved);
		$criteria->compare('varText', $this->varText, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}