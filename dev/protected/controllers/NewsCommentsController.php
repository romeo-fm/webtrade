<?php

class NewsCommentsController extends GxController {


	public function actionView($id) {
        return;
		$this->render('view', array(
			'model' => $this->loadModel($id, 'NewsComments'),
		));
	}

	public function actionCreate() {
        return; /*
		$model = new NewsComments;


		if (isset($_POST['NewsComments'])) {
			$model->setAttributes($_POST['NewsComments']);

			if ($model->save()) {
				if (Yii::app()->getRequest()->getIsAjaxRequest())
					Yii::app()->end();
				else
					$this->redirect(array('view', 'id' => $model->intCommentID));
			}
		}

		$this->render('create', array( 'model' => $model)); */
	}

	public function actionUpdate($id) {
		$model = $this->loadModel($id, 'NewsComments');
		$modelNew = NewsPublic::model()->findAll('intNewPublicID = ' . $model->intNewPublicID);
		$modelNew = count($modelNew) ? $modelNew[0] : new stdClass();
        //var_dump($modelNew[0]);die;


		if (isset($_POST['NewsComments'])) {
			$model->setAttributes($_POST['NewsComments']);

			if ($model->save()) {
				$this->redirect("/newsComments");
			}
		}

		$this->render('update', array(
				'model' => $model,
				'modelNew' => $modelNew,
				));
	}

	public function actionDelete($id) {
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$this->loadModel($id, 'NewsComments')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
                $this->redirect("/newsComments");
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
        $model = new NewsComments('search');
        $model->unsetAttributes();

        $criteria = new CDbCriteria;
        $criteria->select = "max(intCommentID) intCommentID";
        $lastCommentID = NewsComments::model()->find($criteria);

        if (isset($_GET['NewsComments']))
            $model->setAttributes($_GET['NewsComments']);

        $this->render('index', array(
            'model' => $model,
            'lastCommentID' => $lastCommentID->intCommentID
        ));
	}

	public function actionDeactivate() {
        if (isset($_POST['id']) && (intval($_POST['id']) > 1)){
            $id = intval($_POST['id']);
            if (isset($_POST['status']) && ((intval($_POST['status']) == 0) || (intval($_POST['status']) == 1))) {
                $status = intval($_POST['status']);
                $result = NewsComments::model()->findByPk($id);
                if (!is_null($result)) {
                    $result->isApproved = $status;
                    $result->save();
                    die('success');
                }
                die('error 1');
            }
            die('error 2');
        }
        die('error 3');
	}

    public function actionCheckComments() {

        if (isset($_POST['lastID']) && (intval($_POST['lastID']) > 1)){
            $id = intval($_POST['lastID']);

            $criteria = new CDbCriteria;
            $criteria->select = "count(1) intCommentID";
            $criteria->condition = 'intCommentID > ' . $id;
            $numNewComments = NewsComments::model()->find($criteria);
            die($numNewComments->intCommentID);
        }
        die(69);
    }

}