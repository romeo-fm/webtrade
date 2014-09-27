<?php

class IndexController extends Controller {
    public $layout = "whitesquare";
    public $cats = array();
    public $menu = array(
        '/' => 'Главное',
        '/currency' => 'Валюты',
        '/banks' => 'Банки',
        '/deposit' => 'Депозиты',
        '/credit' => 'Кредиты',
        '/indexes' => 'Индексы',
        '/economics' => 'Экономика',
    );

	public function actionIndex() {
		$this->render('index', array(/*'cats' => $this->cats*/));
	}

    public function actionError() {
		$this->render('error');
	}

    public function init() {
        $this->cats = Category::model()->findAll("isActive = 1");
        if (ISOWNER) {
           /* Yii::import('application.commands.*');
            $command = new FeedCommand("test", "test");
            $command->run(null);
             die;*/
            //var_dump($_SERVER['REQUEST_URI']);die;
        }
    }

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}