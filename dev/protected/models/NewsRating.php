<?php

Yii::import('application.models._base.BaseNewsRating');

class NewsRating extends BaseNewsRating
{
    public $intCategoryID;
    public $rating;

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

    public static function label($n = 1) {
        return Yii::t('app', 'NewsRating|Рейтинг статей', $n);
    }

    public static function representingColumn() {
        return 'intRatingID';
    }

    public function rules() {
        return array(
            array('intEditionID, intNewPublicID, intLikes, intDisLikes', 'length', 'max'=>10),
            array('intEditionID, intNewPublicID, intLikes, intDisLikes', 'default', 'setOnEmpty' => true, 'value' => null),
            array('intRatingID, intEditionID, intNewPublicID, intLikes, intDisLikes, intCategoryID', 'safe', 'on'=>'search'),
        );
    }

    public function relations() {
        $relations = parent::relations();

        $relations['intNew'] = array(self::BELONGS_TO, 'NewsPublic', 'intNewPublicID','joinType' => 'INNER JOIN');
        $relations['intEdition'] = array(self::BELONGS_TO, 'Editions', 'intEditionID','joinType' => 'INNER JOIN');
        $relations['category'] = array(self::BELONGS_TO,'Category', array('intCategoryID'=>'intCategoryID'),'through'=>'intNew','together' => true, 'joinType' => 'INNER JOIN');

        return $relations;
    }

    public function attributeLabels() {
        return array(
            'intRatingID' => Yii::t('app', 'Int Rating'),
            'intEditionID' => 'Выпуск',
            'intNewPublicID' => 'Статья',
            'intLikes' => Yii::t('app', 'Int Likes'),
            'intDisLikes' => Yii::t('app', 'Int Dis Likes'),
            'intNew' => null,
            'intEdition' => null,
        );
    }

    public function search() {
        $criteria = new CDbCriteria;

        $criteria->with = array('intNew','intEdition','category');
        $criteria->select = ('*, (cast(intLikes AS SIGNED) - cast(intDisLikes AS SIGNED)) AS rating');

        $criteria->compare('intEdition.intEditionID', $this->intEditionID);
        $criteria->compare('intNewPublicID', $this->intNewPublicID);
        $criteria->compare('intLikes', $this->intLikes);
        $criteria->compare('intDisLikes', $this->intDisLikes);
        $criteria->compare('category.intCategoryID', $this->intCategoryID);
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort'=>array(
                'attributes'=>array(
                    'rating'=>array(
                        'asc'=>'rating',
                        'desc'=>'rating DESC',
                    ),
                    '*',
                ),
                'defaultOrder' => 'intNew.intNewPublicID',
            ),
        ));
    }
}