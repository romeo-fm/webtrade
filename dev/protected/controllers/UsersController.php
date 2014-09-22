<?php

class UsersController extends GxController {


	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'Users'),
		));
	}

	public function actionCreate() {
		$model = new Users;


		if (isset($_POST['Users'])) {
            $data = $_POST['Users'];
            $data['varPassword'] = $model->hashPassword($data['varPassword']);

			$model->setAttributes($data);

            try {
                if ($model->save()) {
                    if (Yii::app()->getRequest()->getIsAjaxRequest())
                        Yii::app()->end();
                    else
                        $this->redirect('/users/?suc');
                }

            } catch( Exception $e) {
                $this->redirect('/users/?err');
            }
		}

		$this->render('create', array( 'model' => $model));
	}

	public function actionUpdate($id) {
		$model = $this->loadModel($id, 'Users');


		if (isset($_POST['Users'])) {
            $data = $_POST['Users'];
            $data['varPassword'] = $model->hashPassword($data['varPassword']);

            $model->setAttributes($data);

			if ($model->save()) {
				$this->redirect('/users/?suc');
			}
		}

		$this->render('update', array(
				'model' => $model,
				));
	}

	public function actionDelete($id) {
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$this->loadModel($id, 'Users')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
        $model = new Users('search');
        $model->unsetAttributes();

        if (isset($_GET['Users']))
            $model->setAttributes($_GET['Users']);

        $this->render('index', array(
            'model' => $model,
        ));
	}

	public function actionAdmin() {
		$model = new Users('search');
		$model->unsetAttributes();

		if (isset($_GET['Users']))
			$model->setAttributes($_GET['Users']);

		$this->render('admin', array(
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

}