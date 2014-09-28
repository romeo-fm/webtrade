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
        if (ISOWNER && 1) {
            /*Yii::import('application.commands.*');
            $command = new FeedCommand("test", "test");
            $command->run(null);*/


            try {
                foreach ($this->feedUrl as $name => $url) {
                    $xml = @simplexml_load_file($url);
                    $this->parseFeed($name, $xml);
                }

                $new = new News();

                $new->intCategoryID = 1;
                $new->varTitle = 'titleeee';
                $new->varText = 'hahah';

                if (!$new->save()) {
                    var_dump($new->getErrors());
                    die('error save');
                }

            } catch(CDbException $e) {
                echo $e->getMessage();
                die('error feed');
            }

        }
    }

    public function parseFeed($name, $feed) {
        if ($name == 'finance') {
            try {
                $descr = $feed->channel->description;
                $items = $feed->channel->item;
                foreach ($items as $item) {
                    //var_dump($item);
                    $new = new News();
                    $new->intCategoryID = 1; // TODO: fix + multicats
                    $new->varTitle = $item->title;
                    $new->varText  = $item->description;
                    //$new->varURL = $item['description'];

                    if (!$new->save()) {
                        var_dump($new->getErrors());
                        die('error save');
                    }
                    /*
                     ["pubDate"]=>
                      string(31) "Sun, 28 Sep 2014 20:00:00 +0300"
                      ["title"]=>
                      string(131) ""Нафтогаз" выступает за повышение цены газа для населения в 4 раза в 2014 г."
                      ["description"]=>
                      string(130) ""Нафтогаз" выступает за повышение цены газа для населения в 4 раза в 2014 г"
                      ["link"]=>
                      string(53) "http://news.finance.ua/ru/~/1/0/all/2014/09/28/334916"
                      ["guid"]=>
                      string(53) "http://news.finance.ua/ru/~/1/0/all/2014/09/28/334916"
                      ["category"]=>
                      array(3) {
                        [0]=>
                        string(10) "Казна"
                        [1]=>
                        string(27) "Личные финансы"
                        [2]=>
                        string(20) "Энергетика"
                      }
                      ["enclosure"]=>
                      object(SimpleXMLElement)#75 (1) {
                        ["@attributes"]=>
                        array(3) {
                          ["url"]=>
                          string(49) "http://static.finance.ua/img/lib/ba/5/a9cc05d.jpg"
                          ["length"]=>
                          string(4) "3280"
                          ["type"]=>
                          string(10) "image/jpeg"
                        }
                      }
                    }
                     */

                }
            } catch(CDbException $e) {
                echo $e->getMessage();
                die('error feed');
            }

        }
    }

    public $feedUrl = array(
        'finance' => 'http://news.finance.ua/ru/rss'
    );

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