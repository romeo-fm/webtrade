<?php

class IndexController extends GxController {
    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        $error = Yii::app()->errorHandler->error;
        if($error)
        {
            if(Yii::app()->request->isAjaxRequest)
            {
                echo $error['message'];
            }
            else
            {
                $this->render('error', array('error' => $error));
            }
        }
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
        $model = new stdClass();
        $this->render('index', array('model' => $model));

    }


    public function actionLogin(){
        if (!Yii::app()->user->id) {
            $model = new LoginForm;

            // if it is ajax validation request
            if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form' ) {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }

            // collect user input data
            if (isset($_POST['LoginForm'])) {
                $model->attributes = $_POST['LoginForm'];
                // validate user input and redirect to the previous page if valid
                if ($model->validate() && $model->login()) {
                    $this->redirect('news');
                }
            }
            $this->render('login', array( 'model' => $model ));
        } else {
            $this->redirect('news');
        }

    }


    public function actionLogout()  {
        Yii::app()->user->logout();
        $this->redirect('/');
    }

    /*
    protected function beforeAction($event) {

    }
*/

}