<?php

Yii::import('application.models._base.BaseEditions');

class Editions extends BaseEditions
{
    public $numNewsInEdition;
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

    public static function representingColumn() {
        return 'intEditionID';
    }

    public static function label($n = 1) {
        return Yii::t('app', 'Editions|Выпуски', $n);
    }

    public function rules() {
        return array(
            array('intNumByMonth, intMonth, isPublic, intYear', 'required'),
            array('intNumByMonth, intMonth, isPublic', 'numerical', 'integerOnly'=>true),
            array('intYear', 'length', 'max'=>4),
            array('varText', 'safe'),
            array('intNumByMonth, intMonth, intYear, varText, isPublic', 'default', 'setOnEmpty' => true, 'value' => null),
            array('intEditionID, intNumByMonth, intMonth, intYear, varText, isPublic', 'safe', 'on'=>'search'),
        );
    }


    public function attributeLabels() {
        return array(
            'intEditionID' => Yii::t('app', 'ID'),
            'intNumByMonth' => Yii::t('app', 'Номер в месяце'),
            'intMonth' => Yii::t('app', 'Месяц'),
            'intYear' => Yii::t('app', 'Год'),
            'varText' => Yii::t('app', 'Var Text'),
            'isPublic' => Yii::t('app', 'Опубликована'),
            'intEdition' => 'Выпуск',
            'newsComments' => null,
            'varMarketID' => 'MarketID',
            'newsRatings' => null,
        );
    }

    public function relations() {
        return array(
            'newsComments' => array(self::HAS_MANY, 'NewsComments', 'intEditionID'),
            'newsPublics' => array(self::HAS_MANY, 'NewsPublic', 'intEditionID'),
            'newsRatings' => array(self::HAS_MANY, 'NewsRating', 'intEditionID'),
        );
    }


    public function search() {
        $criteria = new CDbCriteria;
        $criteria->alias = 'ed';
        $criteria->join = 'LEFT JOIN `news_public` np ON
           ((ed.`intEditionID` = np.`intEditionID`))';

        $criteria->compare('intEditionID', $this->intEditionID);
        $criteria->compare('intEditionID', $this->intEditionID, true);
        $criteria->compare('intNumByMonth', $this->intNumByMonth);
        $criteria->compare('intMonth', $this->intMonth);
        $criteria->compare('intYear', $this->intYear, true);
        $criteria->compare('varText', $this->varText, true);
        $criteria->compare('isPublic', $this->isPublic);
        $criteria->compare('varMarketID', $this->varMarketID);
        $criteria->group = 'ed.intEditionID';
        $criteria->select = 'ed.*,count(np.intEditionID) as numNewsInEdition';

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort'=>array(
                'attributes'=>array(
                ),
                'defaultOrder' => 'isPublic,dtPublic DESC',
            ),
        ));
    }

    public function updateNewsToPublic($edID) {
        $connection = Yii::app()->db;
        $transaction = $connection->beginTransaction();
        try {
            $params = array(
                ':intEditionID' => intval($edID),
            );

            $connection->createCommand('
                    UPDATE
                        news_public np INNER JOIN news n ON np.intNewID = n.intNewID
                      SET
                        n.isPublic=1
                      WHERE
                        np.intEditionID = :intEditionID')->execute($params);
            $transaction->commit();
            return true;

        } catch(CDbException $e) {
            $transaction->rollback;
            die("Невозможно опубликовать новости");

        } catch(Exception $e) {
            $transaction->rollback;
            die("Невозможно опубликовать новость");
        }

    }
}