<?php

Yii::import('application.models._base.BaseCategory');

class Category extends BaseCategory
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}


    public function attributeLabels() {
        return array(
            'intCategoryID' => Yii::t('app', 'Категории'),
            'varTitle' => Yii::t('app', 'Заголовок'),
            'isActive' => Yii::t('app', 'Активная'),
            'news' => null,
        );
    }

    public static function label($n = 1) {
        return Yii::t('app', 'Category|Рубрики', $n);
    }


    public function search() {
        $criteria = new CDbCriteria;

        $criteria->compare('intCategoryID', $this->intCategoryID, true);
        $criteria->compare('varTitle', $this->varTitle, true);
        $criteria->compare('isActive', $this->isActive);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort'=>array(
                'defaultOrder' => 'isActive DESC, varTitle',
            ),
        ));
    }
}