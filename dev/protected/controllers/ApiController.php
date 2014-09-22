<?php

class ApiController extends Controller
{
    private $format = 'json';
    private $error = array('code' => 0, 'msg' => '');

    private $intEditionID = -1;
    private $intNewID = -1;
    private $intPerPage = 10;
    private $intPage = -1;
    private $intValue = 0;
    private $varName = '';
    private $varText = '';
    private $varEmail = '';
    private $yearSience = NULL;
    private $monthSience = NULL;

    public $layout='//layouts/api';


    public function actionCommentsView() {
        $webRequest = Yii::app()->getRequest();

        $intNewID = $webRequest->getQuery ("intNewID");
        $intEditionID = $webRequest->getQuery("intEditionID");
        $intPerPage = $webRequest->getQuery("intPerPage");
        $intPage = $webRequest->getQuery("intPage");
        $data = new stdClass();

        // validate:
        if (is_null($intEditionID) || ($intEditionID < 1)) {
            $this->error['code'] = 1;
            $this->error['msg'] = "Номер выпуска 0 или пуст";
            $this->sendResponse(200, false, 'application/json', $this->error, false);
        } elseif (is_null($intNewID) || ($intNewID < 1)) {
            $this->error['code'] = 2;
            $this->error['msg'] = "Номер новости 0 или пуст";
            $this->sendResponse(200, false, 'application/json', $this->error, false);
        } elseif (is_null($intPerPage) || ($intPerPage < 1)) {
            $this->error['code'] = 2;
            $this->error['msg'] = "Количество на странице 0 или пусто";
            $this->sendResponse(200, false, 'application/json', $this->error, false);
        } elseif (is_null($intPage) || ($intPage < 1)) {
            $this->error['code'] = 2;
            $this->error['msg'] = "Номер страницы 0 или пусто";
            $this->sendResponse(200, false, 'application/json', $this->error, false);
        }

        $this->intEditionID = (int)$intEditionID;
        $this->intNewID = (int)$intNewID;
        $this->intPerPage = (int)$intPerPage;
        $this->intPage = (int)$intPage;


        $condition = 'intEditionID = ' . $this->intEditionID
            . " AND intNewPublicID = " . $this->intNewID
            . " AND isApproved = 1 "
            . " LIMIT " . ($this->intPage - 1) * $this->intPerPage . ", " . $this->intPerPage;
        $comments = NewsComments::model()->findAll($condition);

        $condition = 'intEditionID = ' . $this->intEditionID
            . " AND intNewPublicID = " . $this->intNewID
            . " AND isApproved = 1 "
            . " ORDER BY intCommentID ";
        $countComments = NewsComments::model()->count($condition);
        $data->totalcount = $countComments;
        $data->pages = @ceil($data->totalcount / $this->intPerPage );
        $data->comments = array();

        if ((is_array($comments) && count($comments))) {
            foreach ($comments as $comment) { // достаем выпуски
                $item = new stdClass();
                $item->varName = $comment->varName;
                $item->varText = $comment->varText;
                $item->intCommentID = $comment->intCommentID;
                $data->comments[] = $item;

            }
        }
        $this->sendResponse(200, $data);
    }

    public function actionCommentsCreate() {
        $webRequest = Yii::app()->getRequest();

        $intNewID = $webRequest->getPost ("intNewID");
        $intEditionID = $webRequest->getPost("intEditionID");
        $varName = $webRequest->getPost("varName");
        $varText = $webRequest->getPost("varText");
        $data = new stdClass();

        // validate:
        if (is_null($intEditionID) || ($intEditionID < 1)) {
            $this->error['code'] = 1;
            $this->error['msg'] = "Номер выпуска 0 или пуст";
            $this->sendResponse(200, false, 'application/json', $this->error, false);
        } elseif (is_null($intNewID) || ($intNewID < 1)) {
            $this->error['code'] = 2;
            $this->error['msg'] = "Номер новости 0 или пуст";
            $this->sendResponse(200, false, 'application/json', $this->error, false);
        } elseif (is_null($varName) || (empty($varName))) {
            $this->error['code'] = 3;
            $this->error['msg'] = "Имя пусто";
            $this->sendResponse(200, false, 'application/json', $this->error, false);
        } elseif (is_null($varText) || (empty($varText))) {
            $this->error['code'] = 4;
            $this->error['msg'] = "Коммент пуст";
            $this->sendResponse(200, false, 'application/json', $this->error, false);
        }

        $this->intNewID = (int)$intNewID;
        $this->intEditionID = (int)$intEditionID;
        $this->varName = mysql_real_escape_string($varName);
        $this->varText = mysql_real_escape_string($varText);

        $newComment = new NewsComments();
        $newComment->intEditionID = $this->intEditionID;
        $newComment->intNewPublicID = $this->intNewID;
        $newComment->varName = $this->varName;
        $newComment->varText = $this->varText;


        if ($newComment->save()) {
            $this->sendResponse(200, $data);
        } else {
            $this->error['code'] = 5;
            $this->error['msg'] = "Невозможно добавить комментарий";
            $this->sendResponse(200, false, 'application/json', $this->error, false);
        }
    }

    public function actionNewsView() {
        if (1) {
            $webRequest = Yii::app()->getRequest();

            $intEditionID = $webRequest->getQuery("intEditionID");
            $varAfterTime = $webRequest->getQuery("varAfterTime");

            if(is_null($intEditionID) || $intEditionID < 0 || is_null($varAfterTime) || (string)$varAfterTime === "") {
                $this->error['code'] = 1;
                $this->error['msg'] = "Номер выпуска пуст или время не указано";
                $this->sendResponse(200, false, 'application/json', $this->error, false);
            }

            $this->intEditionID = (int)$intEditionID;
            $varAfterTime = (string)$varAfterTime;

            if ($varAfterTime){
                $dateObj = date_parse_from_format("d-m-YYYY", $varAfterTime);
                $this->yearSience = $dateObj['year'];
                $this->monthSience = $dateObj['month'];

                $data = array();

            }

            if ($this->intEditionID == 0) {
                $condition = 'isPublic=1'
                        . ($this->yearSience ? " AND intYear >= ".$this->yearSience : '')
                        . ($this->monthSience ? " AND intMonth >= ".$this->monthSience : '');
                $editions = Editions::model()->findAll($condition);

            } else {
                $condition = 'isPublic = 1 AND intEditionID = ' . $this->intEditionID . ' limit 1';
                $editions = Editions::model()->findAll($condition);

            }

            if ((is_array($editions) && count($editions))) {
                foreach ($editions as $edition) { // достаем выпуски
                    $item = new stdClass();
                    $item->intEditionID = $edition->intEditionID;
                    $item->intNumByMonth = $edition->intNumByMonth;
                    $item->intMonth = $edition->intMonth;
                    $item->intYear = $edition->intYear;
                    $item->varMarketID = $edition->varMarketID;
                    $item->varText = array();

                    // достаем статьи в выпуске:
                    $condition = 'isPublic = 1 AND intEditionID = ' . $edition->intEditionID;
                    $news = NewsPublic::model()->findAll($condition);

                    if (is_array($news) && count($news)) {
                        foreach ($news as $new) {
                            $itemNew = new stdClass();
                            $itemNew->intNewID = $new->intNewPublicID;
                            $itemNew->varTitle = $new->varTitle;
                            $itemNew->varTizer = $new->varTizer;
                            $itemNew->varMailText = $new->varMailText;
                            $itemNew->isFree   = $new->isFree;
                            $itemNew->intCategoryID = $new->intCategoryID;
                            $itemNew->gallery = array();

                            // достаем фото:
                            $condition = 'intNewPublicID = ' . $new->intNewPublicID;
                            $result = NewsPublicGallery::model()->findAll($condition);

                            if ((is_array($result) && count($result))) {
                                foreach ($result as $newPhoto) {
                                    $itemPhoto = new stdClass();
                                    $itemPhoto->varHash = ('/gallery/' . $newPhoto->varHash . '.png');
                                    //$itemPhoto->varHash = $this->createAbsoluteUrl('/gallery/' . $newPhoto->varHash . '.jpg');
                                    $itemPhoto->name = $newPhoto->name;
                                    $itemNew->gallery[] = $itemPhoto;

                                }
                            }
                            $item->varText[] = $itemNew;
                        }
                    }
                    $data[] = $item;
                }
            }
            $this->sendResponse(200, $data);
        }
        else {
            $this->sendResponse(501, false, 'application/json', sprintf(
                'Error: Mode list is not implemented for model %s',
                Yii::app()->controller->action->id), false);
        }
    }


    public function actionNewsbodyView() {
        $webRequest = Yii::app()->getRequest();

        $intNewID = $webRequest->getQuery("intNewID");
        $data = new stdClass();

        if (is_null($intNewID) || ($intNewID < 1)) {
            $this->error['code'] = 2;
            $this->error['msg'] = "Номер статьи пуст";
            $this->sendResponse(200, false, 'application/json', $this->error, false);
        }

        $this->intNewID = (int)$intNewID;

        $condition = 'isPublic=1 AND intNewPublicID = ' . $this->intNewID .' limit 1';
        $result = NewsPublic::model()->findAll($condition);

        if ((is_array($result) && count($result))) {
            $new = $result[0];
            $item = new stdClass();
            $item->intNewID = $new->intNewPublicID;
            $item->varText = $new->varText;
            $item->varTitle = $new->varTitle;
            $item->varTizer = $new->varTizer;
            $item->varMailText = $new->varMailText;
            $item->isFree = $new->isFree;
            $item->intCategoryID = $new->intCategoryID;
            $item->gallery = array();

            // достаем фото:
            $condition = 'intNewPublicID = ' . $this->intNewID;
            $result = NewsPublicGallery::model()->findAll($condition);

            if ((is_array($result) && count($result))) {
                foreach ($result as $newPhoto) {
                    $itemPhoto = new stdClass();
                    $itemPhoto->varHash = ('/gallery/' . $newPhoto->varHash . '.png');
                    //$itemPhoto->varHash = $this->createAbsoluteUrl('/gallery/' . $newPhoto->varHash . '.jpg');
                    $itemPhoto->name = $newPhoto->name;
                    $item->gallery[] = $itemPhoto;

                }
            }

            $data = $item;
        }
        $this->sendResponse(200, $data);
    }


    public function actionRatingCreate() {
        $webRequest = Yii::app()->getRequest();

        $intEditionID = $webRequest->getPost("intEditionID");
        $intNewID = $webRequest->getPost ("intNewID");
        $intValue = $webRequest->getPost("intValue");
        $varEmail = $webRequest->getPost("varEmail");
        $data = new stdClass();

        // validate:
        if (is_null($intNewID) || ($intNewID < 1)) {
            $this->error['code'] = 2;
            $this->error['msg'] = "Номер статьи пуст";
            $this->sendResponse(200, false, 'application/json', $this->error, false);
        } elseif (is_null($intValue) || (!in_array($intValue, array('-1', '1')))) {
            $this->error['code'] = 3;
            $this->error['msg'] = "Неверное значение для рейтинга";
            $this->sendResponse(200, false, 'application/json', $this->error, false);
        } elseif (is_null($intEditionID) || ($intEditionID < 1)) {
            $this->error['code'] = 1;
            $this->error['msg'] = "Номер выпуска 0 или пуст";
            $this->sendResponse(200, false, 'application/json', $this->error, false);
        } elseif (is_null($varEmail) || ($varEmail == '')) {
            $this->error['code'] = 7;
            $this->error['msg'] = "Представьтесь для внесения рейтинга";
            $this->sendResponse(200, false, 'application/json', $this->error, false);
        }
        $this->intNewID = (int)$intNewID;
        $this->intValue = (int)$intValue;
        $this->intEditionID = (int)$intEditionID;
        $this->varEmail= mysql_real_escape_string($varEmail);

        // froud control 1 vote from 1 users
        $subs = Subscribers::model()->findAll('varEmail=:varEmail', array(':varEmail' => $this->varEmail));
        if (count($subs)) {
            $subscriber = $subs[0];

            $newRatingRes = NewsRating::model()->findAll('intNewPublicID = ' . $this->intNewID);
            if ((is_array($newRatingRes) && (count($newRatingRes) == 0))) { // если нет рейтинга, то создаем:
                $newRes = NewsPublic::model()->findAll('isPublic = 1 AND intNewPublicID = ' . $this->intNewID);

                if ((is_array($newRes) && count($newRes))) {
                    $new = $newRes[0];
                    $editionRes = Editions::model()->findAll('isPublic = 1 AND intEditionID = ' . $new->intEditionID);

                    if ((is_array($editionRes) && count($editionRes))) {
                        $newRating = new NewsRating();
                        $newRating->intEditionID = $new->intEditionID;
                        $newRating->intNewPublicID = $this->intNewID;
                        $newRating->intLikes = 0;
                        $newRating->intDisLikes = 0;

                    } else {
                        $this->error['code'] = 4;
                        $this->error['msg'] = "Выпуск не существует или не опубликован";
                        $this->sendResponse(200, false, 'application/json', $this->error, false);
                    }
                } else {
                    $this->error['code'] = 3;
                    $this->error['msg'] = "Номер статьи не предадлежит к опубликованному выпуску";
                    $this->sendResponse(200, false, 'application/json', $this->error, false);

                }
            } else {
                $newRating = $newRatingRes[0];
            }

            $newsRatingSubs = new NewsRatingSubscribers();
            $newsRatingSubs->intEditionID = $this->intEditionID;
            $newsRatingSubs->intNewPublicID = $this->intNewID;
            $newsRatingSubs->intSubID = $subscriber->intSubID;
            $newsRatingSubs->intRaiting = $this->intValue;

            try {
                if ($newsRatingSubs->save()) {
                    if ($this->intValue == 1) {
                        $newRating->intLikes = $newRating->intLikes + 1;
                    } else {
                        $newRating->intDisLikes = $newRating->intDisLikes + 1;
                    }

                    //add rating
                    if ($newRating->save()) {
                        $data->intPositive = $newRating->intLikes;
                        $data->intNegative = $newRating->intDisLikes;
                        $this->sendResponse(200, $data);
                    } else {
                        $this->error['code'] = 8;
                        $this->error['msg'] = "Невозможно обновить рейтинг";
                        $this->sendResponse(200, false, 'application/json', $this->error, false);
                    }
                }

            } catch(CDbException $e) {
                $this->error['code'] = 5;
                $this->error['msg'] = "Вы уже оценили статью";
                $this->sendResponse(200, false, 'application/json', $this->error, false);

            }

        } else {
            $this->error['code'] = 6;
            $this->error['msg'] = "Подписчик не зарегистрирован";
            $this->sendResponse(200, false, 'application/json', $this->error, false);
        }

    }


    public function actionRatingView() {
        $webRequest = Yii::app()->getRequest();
        $spike = true;
        //TODO: change later, bug from mobile dev

        $intEditionID = $webRequest->getQuery("intEditionID");
        $intNewID = $webRequest->getQuery("intNewID");
        $data = new stdClass();

        if (is_null($intNewID) || ($intNewID < 1)) {
            $this->error['code'] = 2;
            $this->error['msg'] = "Номер статьи пуст";
            $this->sendResponse(200, false, 'application/json', $this->error, false);
        }elseif ((is_null($intEditionID) || ($intEditionID < 1)) && !$spike) {
            $this->error['code'] = 1;
            $this->error['msg'] = "Номер выпуска пуст";
            $this->sendResponse(200, false, 'application/json', $this->error, false);
        }

        $this->intEditionID = (int)$intEditionID;
        $this->intNewID = (int)$intNewID;

        $condition = 'intNewPublicID = ' . $this->intNewID .
            (!$spike ? " AND intEditionID = " . $this->intEditionID . ' limit 1' : "" );
        $result = NewsRating::model()->findAll($condition);

        if ((is_array($result) && count($result))) {
            $item = $result[0];

            $data->intPositive = $item->intLikes;
            $data->intNegative = $item->intDisLikes;

            // TODO: достаем фото
        } else {
            $data->intPositive = 0;
            $data->intNegative = 0;
        }
        $this->sendResponse(200, $data);
    }


    public function actionCategoryView() {
        $cats = new Category;
        $activeCats = $cats->findAll('isActive = 1');

        if (count($activeCats)) {
            $data = new stdClass();
            $data->categories = array();
            foreach ($activeCats as $cat) {
                $data->categories[] = array(
                                'intCategoryID' => $cat->intCategoryID,
                                'varTitle'      => $cat->varTitle
                );
            }
            $this->sendResponse(200, $data);
        } else {
            $this->error['code'] = 1;
            $this->error['msg'] = "Нет активных категорий";
            $this->sendResponse(200, false, 'application/json', $this->error, false);
        }
    }

    public function actionPushmeCreate() {
        // TODO: check is mail
        if (!isset($_POST['varEmail']) || (strlen($_POST['varEmail']) < 5)) {
            $this->error['code'] = 1;
            $this->error['msg'] = 'почта не может быть пустой';
        }
        elseif (!isset($_POST['varToken']) || (strlen($_POST['varToken']) < 20)) {
            $this->error['code'] = 2;
            $this->error['msg'] = 'токен не может быть пустым';
        } elseif (!isset($_POST['varOS']) || !in_array($_POST['varOS'], array(1,2))) {
            $this->error['code'] = 3;
            $this->error['msg'] = 'OS не может быть пустой';
        }

        if ($this->error['code'] == 0) {
            try {
                $subs = new Subscribers();
                $subs->varToken = mysql_real_escape_string($_POST['varToken']);
                $subs->varEmail = mysql_real_escape_string($_POST['varEmail']);
                $subs->varOS = mysql_real_escape_string($_POST['varOS']);
                $data = new stdClass();

                $isTokenLive = Subscribers::model()->findByAttributes(array(
                            'varOS' => $subs->varOS,
                            'varEmail' => $subs->varEmail,
                            'varToken' => $subs->varToken,
                ));

                if ($isTokenLive === null) {
                    if(!$subs->save()) {
                        $this->error['code'] = 4;
                        $this->error['msg'] = "I can't save this record";
                    } else {
                        $this->sendResponse(200, $data);
                    }

                } else {
                    $this->sendResponse(200, $data);
                }
            } catch (Exception $e) {

                $this->error['code'] = 5;
                $this->error['msg'] = 'Данный token принадлежит другому подписчику';
            }
        }
        $this->sendResponse(501, false, 'application/json', $this->error, false);
    }

    protected function sendResponse($status = 200, $data = '', $contentType = 'application/json', $error = array('code' => 0, 'msg' => ''), $url = false) {
        if ($error['code'] == 69) {
            $error['msg'] = 'Неведомая ошибка';
        }

        // Set the status
        $statusHeader = 'HTTP/1.1 ' . $status . ' ' . $this->getStatusCodeMessage($status);
        header($statusHeader);
        // Set the content type
        header('Content-type: ' . $contentType);

        if ($url) {
            $answer = file_get_contents($url);
        } else {
            $answer = array();
            $answer['error'] = $error;
            $answer['data'] = ($data ? $data : new stdClass() );
            $answer = CJSON::encode($answer);
        }

        echo $answer;
        Yii::app()->end();
    }

    /**
     * Return the http status message based on integer status code
     * @param int $status HTTP status code
     * @return string status message
     */
    protected function getStatusCodeMessage($status)
    {
        $codes = array(
            100 => 'Continue',
            101 => 'Switching Protocols',
            200 => 'OK',
            201 => 'Created',
            202 => 'Accepted',
            203 => 'Non-Authoritative Information',
            204 => 'No Content',
            205 => 'Reset Content',
            206 => 'Partial Content',
            300 => 'Multiple Choices',
            301 => 'Moved Permanently',
            302 => 'Found',
            303 => 'See Other',
            304 => 'Not Modified',
            305 => 'Use Proxy',
            306 => '(Unused)',
            307 => 'Temporary Redirect',
            400 => 'Bad Request',
            401 => 'Unauthorized',
            402 => 'Payment Required',
            403 => 'Forbidden',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            406 => 'Not Acceptable',
            407 => 'Proxy Authentication Required',
            408 => 'Request Timeout',
            409 => 'Conflict',
            410 => 'Gone',
            411 => 'Length Required',
            412 => 'Precondition Failed',
            413 => 'Request Entity Too Large',
            414 => 'Request-URI Too Long',
            415 => 'Unsupported Media Type',
            416 => 'Requested Range Not Satisfiable',
            417 => 'Expectation Failed',
            500 => 'Internal Server Error',
            501 => 'Not Implemented',
            502 => 'Bad Gateway',
            503 => 'Service Unavailable',
            504 => 'Gateway Timeout',
            505 => 'HTTP Version Not Supported',

        );
        return (isset($codes[$status])) ? $codes[$status] : '';
    }


    public function actionList()
    {
        return;
        if (isset($_GET['model']))
            $_model = CActiveRecord::model(ucfirst($_GET['model']));

        if (isset($_model))
        {
            $_data = $_model->summary($_GET)->findAll();

            if (empty($_data))
                $this->sendResponse(200, sprintf('No items were found for model <b>%s</b>', $_GET['model']));
            else
            {
                $_rows = array();

                foreach ($_data as $_d)
                    $_rows[] = $_d->attributes;

                $this->sendResponse(200, CJSON::encode($_rows));
            }
        }
        else
        {
            $this->sendResponse(501, sprintf(
                'Error: Mode <b>list</b> is not implemented for model <b>%s</b>',
                $_GET['model']));
            Yii::app()->end();
        }
    }

    public function actionView()
    {
        return;
        if (isset($_GET['model']))
            $_model = CActiveRecord::model(ucfirst($_GET['model']));

        if (isset($_model))
        {
            $_data = $_model->findByPk($_GET['id']);

            if (empty($_data))
                $this->sendResponse(200, sprintf('No items were found for model <b>%s</b>', $_GET['model']));
            else
                $this->sendResponse(200, CJSON::encode($_data));
        }
        else
        {
            $this->sendResponse(501, sprintf(
                'Error: Mode <b>list</b> is not implemented for model <b>%s</b>',
                $_GET['model']));
            Yii::app()->end();
        }
    }

    public function actionCreate()
    {
        return;
        $post = Yii::app()->request->rawBody;

        if (isset($_GET['model']))
        {
            $_modelName = ucfirst($_GET['model']);
            $_model = new $_modelName;
        }

        if (isset($_model))
        {
            if (!empty($post))
            {
                $_data = CJSON::decode($post, true);

                foreach($_data as $var => $value)
                    $_model->$var = $value;

                if($_model->save())
                    $this->sendResponse(200, CJSON::encode($_model));
                else
                {
                    // Errors occurred
                    $msg = "<h1>Error</h1>";
                    $msg .= sprintf("Couldn't create model <b>%s</b>", $_GET['model']);
                    $msg .= "<ul>";
                    foreach($_model->errors as $attribute => $attr_errors)
                    {
                        $msg .= "<li>Attribute: $attribute</li>";
                        $msg .= "<ul>";
                        foreach($attr_errors as $attr_error)
                            $msg .= "<li>$attr_error</li>";
                        $msg .= "</ul>";
                    }
                    $msg .= "</ul>";
                    $this->sendResponse(500, $msg);
                }
            }
        }
        else
        {
            $this->sendResponse(501, sprintf(
                'Error: Mode <b>create</b> is not implemented for model <b>%s</b>',
                $_GET['model']));
            Yii::app()->end();
        }
    }

    public function actionUpdate()
    {
        return;
        $post = Yii::app()->request->rawBody;

        if (isset($_GET['model']))
        {
            $_model = CActiveRecord::model(ucfirst($_GET['model']))->findByPk($_GET['id']);
            $_model->scenario = 'update';
        }

        if (isset($_model))
        {
            if (!empty($post))
            {
                $_data = CJSON::decode($post, true);

                foreach($_data as $var => $value)
                    $_model->$var = $value;

                if($_model->save())
                {
                    Yii::log('API update -> '.$post, 'info');
                    $this->sendResponse(200, CJSON::encode($_model));
                }
                else
                {
                    // Errors occurred
                    $msg = "<h1>Error</h1>";
                    $msg .= sprintf("Couldn't update model <b>%s</b>", $_GET['model']);
                    $msg .= "<ul>";
                    foreach($_model->errors as $attribute => $attr_errors)
                    {
                        $msg .= "<li>Attribute: $attribute</li>";
                        $msg .= "<ul>";
                        foreach($attr_errors as $attr_error)
                            $msg .= "<li>$attr_error</li>";
                        $msg .= "</ul>";
                    }
                    $msg .= "</ul>";

                    $this->sendResponse(500, $msg);
                }
            }
            else
                Yii::log('POST data is empty');
        }
        else
        {
            $this->sendResponse(501, sprintf(
                'Error: Mode <b>update</b> is not implemented for model <b>%s</b>',
                $_GET['model']));
            Yii::app()->end();
        }
    }

    public function actionDelete()
    {
        return;
        if (isset($_GET['model']))
            $_model = CActiveRecord::model(ucfirst($_GET['model']));

        if (isset($_model))
        {
            $_data = $_model->findByPk($_GET['id']);

            if (!empty($_data))
            {
                $num = $_data->delete();

                if($num > 0)
                    $this->sendResponse(200, $num);    //this is the only way to work with backbone
                else
                    $this->sendResponse(500, sprintf("Error: Couldn't delete model <b>%s</b> with ID <b>%s</b>.", $_GET['model'], $_GET['id']) );
            }
            else
                $this->sendResponse(400, sprintf("Error: Didn't find any model <b>%s</b> with ID <b>%s</b>.", $_GET['model'], $_GET['id']));
        }
        else
        {
            $this->sendResponse(501, sprintf('Error: Mode <b>delete</b> is not implemented for model <b>%s</b>', ucfirst($_GET['model'])));
            Yii::app()->end();
        }
    }

    private function _checkAuth()
    {
        //  ... Yii::log("errors saving SomeModel: " . var_export($someModelObject->getErrors(), true), CLogger::LEVEL_WARNING, __METHOD__);
    }


    public function actionIndex()
    {
        $this->sendResponse(501, sprintf(
            'Error: Mode <b>list</b> is not implemented for model <b>%s</b>',
            Yii::app()->controller->action->id));
        Yii::app()->end();

    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        $this->sendResponse(501, sprintf(
            'Error: Mode <b>list</b> is not implemented for model <b>%s</b>',
            Yii::app()->controller->action->id));
        Yii::app()->end();
    }

}