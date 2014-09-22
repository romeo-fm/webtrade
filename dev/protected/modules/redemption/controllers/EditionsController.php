<?php

class EditionsController extends GxController {


	public function actionView($id) {
        $model = $this->loadModel($id, 'Editions');

        $modelEditionsNews = new NewsPublic();
        $modelEditionsNews = $modelEditionsNews->gridEditions($id);

		$this->render('view', array(
            'model' => $model,
            'modelEditionsNews' => $modelEditionsNews,
		));
	}

	public function actionCreate() {
		$model = new Editions;

		if (isset($_POST['Editions'])) {
			$model->setAttributes($_POST['Editions']);
            $model->varMarketID = $_POST['Editions']['varMarketID'];
			$relatedData = array(
				//'news' => $_POST['Editions']['news'] === '' ? null : $_POST['Editions']['news'],
				);

			if ($model->saveWithRelated($relatedData)) {
				if (Yii::app()->getRequest()->getIsAjaxRequest())
					Yii::app()->end();
				else
                    $this->redirect('/editions/update/' . $model->intEditionID );
			}
		}

        $this->render('create', array(
            'model' => $model,
        ));
	}



    public function actionAddNew() {
        $webRequest = Yii::app()->getRequest();
        $newID = intval($webRequest->getPost("newID"));
        $edID = intval($webRequest->getPost("edID"));

        $modelNew = $this->loadModel($newID, 'News');

        $modelNewPublic = new NewsPublic();
        $attr = $modelNew->attributes;

        $attr['intEditionID'] = $edID;
        $attr['isPublic'] = 0;
        unset($attr['gallery_id']);
        foreach ($attr as $key => $val) {
            $modelNewPublic->$key = $val;
        }

        if ($modelNewPublic->save()) {
            $modelNewPublic->addPhoto($modelNewPublic, $modelNew);
            die('suc');
        } else {
            Yii::log("errors saving modelNewPublic: " . var_export($modelNewPublic->getErrors(), true), CLogger::LEVEL_WARNING, __METHOD__);
            die('fatal');
        }
    }

    protected function checkCountNotRTP($edID) {
        return $countNotRTP = Yii::app()->db->createCommand()
                                ->select('count(IF(isPublic=0, 1, null)) as countNotRTP')
                                ->from('news_public')
                                ->where('intEditionID='.$edID)
                                ->queryColumn();

    }

    // TODO: check category enabled
    public function actionPublic() {
        $error = array('code' => 0, 'msg' => '');
        $data = array();
        $webRequest = Yii::app()->getRequest();
        $edID = intval($webRequest->getPost("edID"));

        if ($edID > 0) {
            $data['countNotRTP'] = $this->checkCountNotRTP($edID);
            if (0 == $data['countNotRTP'][0]) {
                $edition = $this->loadModel($edID, 'Editions');
                $edition->isPublic = 1;
                $edition->dtPublic = new CDbExpression('NOW()');;

                if ($edition->save()) {
                    $this->actionPublicToAndrion($edID);
                    $this->actionPublicToIphone($edID);
                    $edition->updateNewsToPublic($edID);

                    $data['success'] = 1;
                    // TODO: move hear public

                } else {
                    $error['code'] = 3;
                }
            } else {
                $error['code'] = 1;
            }
        } else {
            $error['code'] = 2;
        }

        $answer = array();
        $answer['error'] = $error;
        $answer['data'] = ($data ? $data : new stdClass());
        $answer = CJSON::encode($answer);
        echo $answer;
        Yii::app()->end();
    }

    public function actionGetCountNotRTP() {
        $error = array('code' => 0, 'msg' => '');
        $data = array();


        $webRequest = Yii::app()->getRequest();
        $edID = intval($webRequest->getPost("edID"));
        if ($edID > 0) {
            $data['countNotRTP'] = $this->checkCountNotRTP($edID);
        } else {
            $error['code'] = 1;
        }

        $answer = array();
        $answer['error'] = $error;
        $answer['data'] = ($data ? $data : new stdClass());
        $answer = CJSON::encode($answer);
        echo $answer;
        Yii::app()->end();
    }


    public function actionChangeStatusNewPublic() {
        $error = array('code' => 0, 'msg' => '');
        $data = array();

        $webRequest = Yii::app()->getRequest();
        $edID = intval($webRequest->getPost("edID"));
        $newPublicID = intval($webRequest->getPost("newPublicID"));
        $status = intval($webRequest->getPost("status"));
        if (($edID > 0) && ($newPublicID > 0) && (in_array($status, array(0,1)))) {
            $modelNewPublic = $this->loadModel($newPublicID, 'NewsPublic');
            $modelNewPublic->isPublic = $status;
            if (!$modelNewPublic->save()) {
                Yii::log("errors saving modelNewPublic: " . var_export($modelNewPublic->getErrors(), true), CLogger::LEVEL_WARNING, __METHOD__);
                $error['code'] = 2;
            } else {
                $data['countNotRTP'] = $this->checkCountNotRTP($edID);
            }
        } else {
            $error['code'] = 1;
        }

        $answer = array();
        $answer['error'] = $error;
        $answer['data'] = ($data ? $data : new stdClass());
        $answer = CJSON::encode($answer);
        echo $answer;
        Yii::app()->end();
    }


	public function actionUpdate($id) {
		$model = $this->loadModel($id, 'Editions');
        if (0 == $model->isPublic) {

            $modelEditionsNews = new NewsPublic();
            $modelEditionsNews = $modelEditionsNews->gridEditions($id);
            $modelNews = new News();
            $modelNews->editionsSearch($id);

            if (isset($_POST['Editions'])) {
                $model->setAttributes($_POST['Editions']);
                $model->varMarketID = $_POST['Editions']['varMarketID'];

                $relatedData = array(
                    //'news' => $_POST['Editions']['news'] === '' ? null : $_POST['Editions']['news'],
                );

                if ($model->saveWithRelated($relatedData)) {
                    $this->redirect('/editions');
                }
            }
            $this->render('update', array(
                'model' => $model,
                'modelNews' => $modelNews,
                'modelEditionsNews' => $modelEditionsNews,

            ));
        } else {
            $this->redirect('/editions');
        }
	}

	public function actionIndex() {
        $model = new Editions('search');
        $model->unsetAttributes();

        if (isset($_GET['Editions']))
            $model->setAttributes($_GET['Editions']);

        $this->render('index', array(
            'model' => $model,
        ));
	}

    protected function beforeAction($event)
    {
        parent::beforeAction($event);
        if (!Yii::app()->user->isAdmin) {
            $this->redirect('/');
        }
        return true;
    }


    protected  function actionPublicToAndrion($edID = 0) {
        //echo "start";

        $model = new Editions();
        $model->unsetAttributes();

        $webRequest = Yii::app()->getRequest();

        $registrationIds = array($edID);
        $tokens = Subscribers::model()->findAll('varOS=1');
        $msg = array (
            'message' 		=> 'Доступно новое издание сообщ',
            'title'			=> 'Доступно новое издание титл',
            'intEditionID'	=> $edID,
            /*'subtitle'		=> 'Доступно новое издание описание',
            'tickerText'	=> 'Доступно новое издание текст',
            'vibrate'	=> 1,
            'sound'		=> 1*/
        );


        if (count($tokens)) {
            foreach ($tokens as $token) {
                $headers = array (
                    'Authorization: key=' . Yii::app()->params['ANDROID_API_ACCESS_KEY'] ,
                    'Content-Type: application/json'
                );
                $fields = array (
                    'registration_ids' 	=> array($token->varToken),
                    'data'				=> $msg
                );

                //var_dump($fields);die;
                $ch = curl_init();
                curl_setopt( $ch,CURLOPT_URL, 'https://android.googleapis.com/gcm/send' );
                curl_setopt( $ch,CURLOPT_POST, true );
                curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
                curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
                curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
                curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
                $result = curl_exec($ch );
                curl_close( $ch );

                //echo $result;
            }
        }

        //echo ("\n<br>end ". __CLASS__ . '.' . __FUNCTION__);
    }

    protected function actionPublicToIphone($edID = 0) {
        //echo "start iphone push ";

        $apnsHost = 'gateway.sandbox.push.apple.com';
        $apnsPort = 2195;
        $apnsCert = __DIR__.'/News4SalePush.pem';
        if (!file_exists($apnsCert)){
            die('certificat not found');
        }

        $payload['aps'] = array (
            'alert' => 'Доступно новое издание',
            'badge' => 1,
            'sound' => 'default');

        $payloa['varEditionID'] = $edID;
        $payload = json_encode($payload);
        $passphrase = 'qwer12';

        $model = Subscribers::model()->findAll('varOS=2');
        if (count($model)) {
            foreach ($model as $token) {

                $deviceToken = $token->varToken;
                $streamContext = stream_context_create();
                stream_context_set_option($streamContext, 'ssl', 'local_cert', $apnsCert);
                stream_context_set_option ($streamContext, 'ssl', 'passphrase', $passphrase);

                $apns = stream_socket_client('ssl://' . $apnsHost . ':' . $apnsPort, $error, $errorString, 2, STREAM_CLIENT_CONNECT, $streamContext);

                $apnsMessage = chr(0) . chr(0) . chr(32) . pack('H*', str_replace(' ', '', $deviceToken)) . chr(0) . chr(strlen($payload)) . $payload;
                fwrite($apns, $apnsMessage);

                @socket_close($apns);
                fclose($apns);
            }
        }

       // echo ("\n<br>end ". __CLASS__ . '.' . __FUNCTION__);
    }

}