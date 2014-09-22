<?php

class NewsPublicController extends GxController {


	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'NewsPublic'),
		));
	}

	public function actionCreate() {
		$model = new NewsPublic;


		if (isset($_POST['NewsPublic'])) {
			$model->setAttributes($_POST['NewsPublic']);

			if ($model->save()) {
				if (Yii::app()->getRequest()->getIsAjaxRequest())
					Yii::app()->end();
				else
					$this->redirect(array('view', 'id' => $model->intNewPublicID));
			}
		}

		$this->render('create', array( 'model' => $model));
	}

	public function actionUpdate($id) {
		$model = $this->loadModel($id, 'NewsPublic');


		if (isset($_POST['NewsPublic'])) {
			$model->setAttributes($_POST['NewsPublic']);

			if ($model->save()) {
				$this->redirect(array('view', 'id' => $model->intNewPublicID));
			}
		}

		$this->render('update', array(
				'model' => $model,
				));
	}

	public function actionDelete($id) {
        //Plan::model()->deleteAll( $where );
		if (Yii::app()->getRequest()->getIsPostRequest()) {

            NewsPublicGallery::model()->deleteAll('intNewPublicID = '. intval($id));
			$this->loadModel($id, 'NewsPublic')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('NewsPublic');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new NewsPublic('search');
		$model->unsetAttributes();

		if (isset($_GET['NewsPublic']))
			$model->setAttributes($_GET['NewsPublic']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}