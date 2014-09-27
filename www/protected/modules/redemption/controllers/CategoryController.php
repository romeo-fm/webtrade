<?php

class CategoryController extends GxController {

	public function actionView($id) {
        return;
		$this->render('view', array(
			'model' => $this->loadModel($id, 'Category'),
		));
	}

	public function actionCreate() {
		$model = new Category;


		if (isset($_POST['Category'])) {
			$model->setAttributes($_POST['Category']);

			if ($model->save()) {
				if (Yii::app()->getRequest()->getIsAjaxRequest())
					Yii::app()->end();
				else
					$this->redirect('./?suc=1');
			}
		}

		$this->render('create', array( 'model' => $model));
	}

	public function actionUpdate($id) {
		$model = $this->loadModel($id, 'Category');


		if (isset($_POST['Category'])) {
			$model->setAttributes($_POST['Category']);

			if ($model->save()) {
				$this->redirect('/category?suc=1');
			}
		}

		$this->render('update', array(
				'model' => $model,
				));
	}

	public function actionDelete($id) {
        return;
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$this->loadModel($id, 'Category')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
        $model = new Category('search');
        $model->unsetAttributes();

        if (isset($_GET['Category']))
            $model->setAttributes($_GET['Category']);

        $this->render('index', array(
            'model' => $model,
        ));
	}


}