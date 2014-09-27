<?php

class RedemptionModule extends CWebModule {
    public $layout = 'admin';
	public function init(){
        Yii::app()->setComponents(array(
                'defaultController' => 'index',
                /*'user' => array(
                    'class' => 'AdminWebUser',
                    'allowAutoLogin'=>true,
                    'loginUrl' => Yii::app()->createUrl('admin/index/login'),
                ),
                'authManager' => array(
                    // Будем использовать свой менеджер авторизации
                    'class' => 'PhpAuthManager',
                    // Роль по умолчанию. Все, кто не админы, модераторы и юзеры — гости.
                    'defaultRoles' => array('guest'),
                ),
                'errorHandler'=>array(
                    // use 'site/error' action to display errors
                    'errorAction'=>'admin/index/error',
                ),
                'bootstrap' => array(
                    'class' => 'bootstrap.components.BsApi'
                ),*/
            )
        );
        /*Yii::app()->user->setStateKeyPrefix('_admin');
        $this->setImport(array(
            'redemption.models.*',
            'redemption.components.*',
        ));*/
	}

	public function beforeControllerAction($controller, $action) {

		if(parent::beforeControllerAction($controller, $action)) {
            $controller->layout = $this->layout;
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}
}
