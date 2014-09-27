<?php

class FeedCommand extends CConsoleCommand {

    public function run($args) {

        Yii::log("saving SomeModel: " . var_export($this, true), CLogger::LEVEL_WARNING, __METHOD__);
        Yii::log("errors saving SomeModel: " . var_export($this->getErrors(), true), CLogger::LEVEL_ERROR, __METHOD__);
        echo 'hello success!';
    }

    public function actionIndex($type, $limit=5) {
        echo 'actionIndex success started!';
    }

}