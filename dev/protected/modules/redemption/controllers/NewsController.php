<?php

class NewsController extends GxController {
    private $allowedTags = '<b><i><p><a><ul><li><h1><h2><h3><em><strong>';

    public function actionCreate() {
        $model = new News;


        if (isset($_POST['News'])) {
            $model->setAttributes($_POST['News']);
            $model->varText = strip_tags($model->varText, $this->allowedTags);
            $model->varMailText = strip_tags($model->varMailText, $this->allowedTags);
            $model->varTizer = strip_tags($model->varTizer);

            if ($model->save()) {
                if (Yii::app()->getRequest()->getIsAjaxRequest())
                    Yii::app()->end();
                else
                    $this->redirect('/news/update/' . $model->intNewID);
            }
        }

        $this->render('create', array( 'model' => $model));
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id, 'News');


        if (isset($_POST['News'])) {
            $model->setAttributes($_POST['News']);
            $model->varText = strip_tags($model->varText, $this->allowedTags);
            $model->varMailText = strip_tags($model->varMailText, $this->allowedTags);
            $model->varTizer = strip_tags($model->varTizer);

            if ($model->save()) {
                $this->redirect('/news?suc=1');
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionDelete($id) {
        if (Yii::app()->getRequest()->getIsPostRequest()) {
            $this->loadModel($id, 'News')->delete();

            if (!Yii::app()->getRequest()->getIsAjaxRequest())
                $this->redirect('/news');
        } else
            throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
    }

	public function actionIndex() {
        $model = new News('search');
        $model->unsetAttributes();

        if (isset($_GET['News']))
            $model->setAttributes($_GET['News']);

        $this->render('index', array(
            'model' => $model,
        ));
	}

    public function actionView($id) {
        return;
        $this->render('view', array(
            'model' => $this->loadModel($id, 'News'),
        ));
    }


}