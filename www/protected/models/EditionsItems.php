<?php

Yii::import('application.models._base.BaseEditionsItems');

class EditionsItems extends BaseEditionsItems
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

    public function attributeLabels() {
        return array(
            'intID' => Yii::t('app', 'ID'),
            'intEditionID' => "Выпуск",
            'intNewPublicID' => 'Статья ID',
            'isRTP' => Yii::t('app', 'Опубликована'),
            'intEdition' => null,
            'intNewPublic' => null,
        );
    }


    public function search() {
        $criteria = new CDbCriteria;

        $criteria->compare('intID', $this->intID, true);
        $criteria->compare('intEditionID', $this->intEditionID);
        $criteria->compare('intNewPublicID', $this->intNewPublicID);
        $criteria->compare('isRTP', $this->isRTP);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }


    public function searchItems() {
        $criteria = new CDbCriteria;

        $criteria->compare('intID', $this->intID, true);
        $criteria->compare('intEditionID', $this->intEditionID);
        $criteria->compare('intNewPublicID', $this->intNewPublicID);
        $criteria->compare('isRTP', $this->isRTP);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }




}