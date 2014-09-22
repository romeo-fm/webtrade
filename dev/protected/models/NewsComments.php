<?php

Yii::import('application.models._base.BaseNewsComments');

class NewsComments extends BaseNewsComments
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

    public static function label($n = 1) {
        return Yii::t('app', 'NewsComments|Комментарии', $n);
    }

    public function relations() {
        return array(
            'intNewPublic' => array(self::BELONGS_TO, 'NewsPublic', 'intNewPublicID'),
            'intEdition' => array(self::BELONGS_TO, 'Editions', 'intEditionID'),
        );
    }

    public function attributeLabels() {
        return array(
            'intCommentID' => Yii::t('app', 'ID'),
            'intEditionID' => "Выпуск",
            'intNewPublicID' => 'Статья',
            'varName' => Yii::t('app', 'Пользователь'),
            'isApproved' => Yii::t('app', 'Активный'),
            'varText' => Yii::t('app', 'Комментарий'),
            'intNewPublic' => null,
            'intEdition' => null,
        );
    }

    public function search() {
        $criteria = new CDbCriteria;
        $criteria->with = array('intNewPublic' => array(
            // но нужно выбрать только пользователей с опубликованными записями
            'joinType'=>'INNER JOIN',
            'condition'=>'intNewPublic.isPublic=1',
        ),);

        $criteria->compare('intCommentID', $this->intCommentID, true);
        $criteria->compare('intEditionID', $this->intEditionID);
        $criteria->compare('intNewPublicID', $this->intNewPublicID);
        $criteria->compare('varName', $this->varName, true);
        $criteria->compare('isApproved', $this->isApproved);
        $criteria->compare('varText', $this->varText, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort'=>array(
                'defaultOrder' => 'isApproved, intCommentID DESC',
            ),
        ));
    }
}