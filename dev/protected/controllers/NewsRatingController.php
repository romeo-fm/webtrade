<?php

class NewsRatingController extends GxController {


	public function actionView($id) {
        return;
		$this->render('view', array(
			'model' => $this->loadModel($id, 'NewsRating'),
		));
	}

	public function actionCreate() {
        return;
		$model = new NewsRating;


		if (isset($_POST['NewsRating'])) {
			$model->setAttributes($_POST['NewsRating']);

			if ($model->save()) {
				if (Yii::app()->getRequest()->getIsAjaxRequest())
					Yii::app()->end();
				else
					$this->redirect(array('view', 'id' => $model->intRatingID));
			}
		}

		$this->render('create', array( 'model' => $model));
	}

	public function actionUpdate($id) {
        return;
		$model = $this->loadModel($id, 'NewsRating');


		if (isset($_POST['NewsRating'])) {
			$model->setAttributes($_POST['NewsRating']);

			if ($model->save()) {
				$this->redirect(array('view', 'id' => $model->intRatingID));
			}
		}

		$this->render('update', array(
				'model' => $model,
				));
	}

	public function actionDelete($id) {
        return;
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$this->loadModel($id, 'NewsRating')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
        $model = new NewsRating('search');
        $model->unsetAttributes();

        if (isset($_GET['NewsRating']))
            $model->setAttributes($_GET['NewsRating']);

        $this->render('index', array(
            'model' => $model,
        ));
	}

	public function actionAdmin() {
        return;
		$model = new NewsRating('search');
		$model->unsetAttributes();

		if (isset($_GET['NewsRating']))
			$model->setAttributes($_GET['NewsRating']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}