<?php

Yii::import('application.models._base.BaseNews');

class News extends BaseNews
{
    public function behaviors()
    {
        return array(
            'galleryBehavior' => array(
                'class' => 'ext.galleryManager.GalleryBehavior',
                'idAttribute' => 'gallery_id',
                'versions' => array(
                    'preview' => array(
                        'resize' => array(640, 400),
                        //'centeredpreview' => array( 98, 98 ),
                    ),
                    /*
                    'small' => array(
                        'resize' => array( 170, 93 ),
                        //'centeredpreview' => array( 98, 98 ),
                    ),
                    'medium' => array(
                        'resize' => array( 800, null ),
                    ) */
                ),
                'name' => true,
            )
        );
    }

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

    public static function label($n = 1) {
        return Yii::t('app', 'News|Новости', $n);
    }

    public function attributeLabels() {
        return array(
            'intNewID' => Yii::t('app', 'Int New'),
            'varText' => Yii::t('app', 'Текст'),
            'varTitle' => Yii::t('app', 'Заголовок'),
            'varTizer' => Yii::t('app', 'Анонс'),
            'varMailText' => Yii::t('app', 'EMail Текст'),
            'isFree' => Yii::t('app', 'Бесплатная'),
            'isPublic' => Yii::t('app', 'Опубликована'),
            'intCategoryID' => 'Категория',
            'intCategory' => null,
            'newsGalleries' => 'Фотографии',
        );
    }

    public function relations() {
        return array(
            'intCategory' => array(self::BELONGS_TO, 'Category', 'intCategoryID', 'joinType' => 'INNER JOIN'),
            'newsGalleries' => array(self::HAS_MANY, 'NewsGallery', 'intNewID', 'joinType' => 'INNER JOIN'),
        );
    }

    public static function representingColumn() {
        return 'varTitle';
    }


    public function search() {
        $criteria = new CDbCriteria;
        $criteria->with = array('intCategory');
        $criteria->alias = 'n';


        $criteria->compare('intNewID', $this->intNewID, true);
        $criteria->compare('n.varTitle', $this->varTitle, true);
        $criteria->compare('isFree', $this->isFree);
        $criteria->compare('isPublic', $this->isPublic);
        $criteria->compare('intCategory.intCategoryID', $this->intCategoryID);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort'=>array(
                'attributes'=>array(
                    'intCategory'=>array(
                        'asc'=>'intCategory.intCategoryID',
                        'desc'=>'intCategory.intCategoryID DESC',
                    ),
                    '*',
                ),
                'defaultOrder' => 'intNewID DESC',
            ),
        ));
    }


    public function editionsSearch($edID) {
        $criteria = new CDbCriteria;
        $criteria->alias = 'n';
        $criteria->with = array('intCategory',);

        $criteria->join = 'LEFT JOIN `news_public` as np ON
           ((n.`intNewID` = np.`intNewID`) AND np.intEditionID = ' . intval($edID) . ')
                         LEFT JOIN `news_public` as np1 ON
           (np1.intNewID = n.intNewID)
                         LEFT JOIN editions ed ON
            ((ed.intEditionID = np1.intEditionID) AND (ed.isPublic=0))';


        $criteria->addCondition('ISNULL(np.intNewID)');
        $criteria->group = 'n.intNewID';
        $criteria->having = 'COUNT(ed.isPublic) = 0';

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'attributes' => array(
                    'intCategory' => array(
                        'asc' => 'intCategory.intCategoryID',
                        'desc' => 'intCategory.intCategoryID DESC',
                    ),
                    '*',
                ),
                'defaultOrder' => 'n.isPublic,n.intNewID DESC',
            ),
        ));
    }
}