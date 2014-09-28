<?php

class FeedCommand extends CConsoleCommand {
    public $feedUrl = array(
        'finance' => 'http://news.finance.ua/ru/rss'
    );

    public function run($args) {
/*
        Yii::log("saving SomeModel: " . var_export($this, true));
        Yii::log("errors saving SomeModel: " . var_export($this->getErrors(), true));*/
        echo "console start!\n";
        $this->getFeed();
        echo "\nconsole end success!\n";
    }

    public function getFeed() {
        try {
            foreach ($this->feedUrl as $name => $url) {
                $xml = @simplexml_load_file($url);
                var_dump($xml);
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