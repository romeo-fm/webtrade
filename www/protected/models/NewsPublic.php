<?php

Yii::import('application.models._base.BaseNewsPublic');

class NewsPublic extends BaseNewsPublic
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

    public static function representingColumn() {
        return 'Новости опубликованные';
    }


    public function attributeLabels() {
        return array(
            'intNewPublicID' => Yii::t('app', 'Int New Public'),
            'intEditionID' => Yii::t('app', 'Выпуск'),
            'intNewID' => Yii::t('app', 'Int New'),
            'varText' => Yii::t('app', 'Var Text'),
            'varTitle' => Yii::t('app', 'Статья'),
            'varTizer' => Yii::t('app', 'Var Tizer'),
            'varMailText' => Yii::t('app', 'Var Mail Text'),
            'isFree' => Yii::t('app', 'Is Free'),
            'isPublic' => Yii::t('app', 'Is Public'),
            'intCategoryID' => null,
            'editions' => null,
            'newsComments' => null,
            'intCategory' => null,
            'newsPublicGalleries' => null,
            'newsRatings' => null,
        );
    }

    public function relations() {
        return array(
            'editions' => array(self::BELONGS_TO, 'Editions', 'intEditionID'),
            'newsComments' => array(self::HAS_MANY, 'NewsComments', 'intNewPublicID'),
            'intCategory' => array(self::BELONGS_TO, 'Category', 'intCategoryID'),
            'newsPublicGalleries' => array(self::HAS_MANY, 'NewsPublicGallery', 'intNewPublicID'),
            'newsRatings' => array(self::HAS_MANY, 'NewsRating', 'intNewPublicID'),
        );
    }

    public function gridEditions($edID) {
        $criteria = new CDbCriteria;
        $criteria->with = array('intCategory' => array(
            'joinType'=>'INNER JOIN',
        ));

        $criteria->compare('intEditionID', intval($edID), false);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function addPhoto($modelNewPublic, $modelNew) {
        $connection = Yii::app()->db;
        $transaction = $connection->beginTransaction();
        try {

            $params = array(
                ':intNewPublicID' => $modelNewPublic->intNewPublicID,
                ':intNewID' => $modelNew->intNewID,
            );


            $connection->createCommand('
                      INSERT INTO news_public_gallery
                    (
                      intNewPublicID
                     ,name
                     ,varHash
                    )
                    SELECT
                      :intNewPublicID,
                      ngp.file_name,
                      ngp.id
                      FROM news INNER JOIN news_gallery_photo ngp ON news.gallery_id = ngp.gallery_id
                      WHERE intNewID = :intNewID')->execute($params);
            $transaction->commit();
            return true;

        } catch(CDbException $e) {
            $transaction->rollback;
            die("Невозможно сохранить фото");

        } catch(Exception $e) {
            $transaction->rollback;
            die("Невозможно сохранить фотографии");
        }

    }
}