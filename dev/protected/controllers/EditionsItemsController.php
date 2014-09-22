<?php

class EditionsItemsController extends GxController {


	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'EditionsItems'),
		));
	}

	public function actionCreate() {
		$model = new EditionsItems;


		if (isset($_POST['EditionsItems'])) {
			$model->setAttributes($_POST['EditionsItems']);

			if ($model->save()) {
				if (Yii::app()->getRequest()->getIsAjaxRequest())
					Yii::app()->end();
				else
					$this->redirect(array('view', 'id' => $model->intID));
			}
		}

		$this->render('create', array( 'model' => $model));
	}

	public function actionUpdate($id) {
		$model = $this->loadModel($id, 'EditionsItems');


		if (isset($_POST['EditionsItems'])) {
			$model->setAttributes($_POST['EditionsItems']);

			if ($model->save()) {
				$this->redirect(array('view', 'id' => $model->intID));
			}
		}

		$this->render('update', array(
				'model' => $model,
				));
	}

	public function actionDelete($id) {
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$this->loadModel($id, 'EditionsItems')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('EditionsItems');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new EditionsItems('search');
		$model->unsetAttributes();

		if (isset($_GET['EditionsItems']))
			$model->setAttributes($_GET['EditionsItems']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}