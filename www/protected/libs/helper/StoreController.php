<?php

/**
 * Store conroller
 */
class StoreController extends Controller
{

	public static function getModel()
	{
		return Store::model();
	}

	public function filters()
	{
		return array(
			'accessControl',
		);
	}

	public function accessRules()
	{
		return array(
			array('allow',
                'actions'=>array('like', 'unlike', 'follow', 'unfollow'),
                'users'=>array('@'),
            ),
			array('allow',
				'actions' => array('delete'),
				'roles' => array(Users::ROLE_ADMIN),
			),
			array('allow',
				'actions' => array('update', 'brands', 'uploadLogo', 'deleteLogo', 'promo'),
				'roles' => array(Users::ROLE_ADMIN, Users::ROLE_SUPERUSER),
			),
			array('allow',
				'actions' => array('update', 'brands', 'uploadLogo', 'deleteLogo', 'promo'),
				'roles' => array(Users::ROLE_NORMALUSER),
				'expression' => 'Store::accessUser2Store($_GET["id"])',
			),
			array('deny',
				'actions' => array('update', 'brands', 'uploadLogo', 'deleteLogo', 'promo', 'like', 'unlike', 'follow', 'unfollow'),
				'users' => array('*'),
			),
		);
	}

	function actions()
	{
		$model = self::getModel();
		return array(
			'view' => array(
				'class' => 'application.controllers.actions.ViewAction',
				'model' => $model,
				'with' => array('brands' => array(
						'order' => 'brands.premium_due_date DESC',
					))
			),
			'update' => array(
				'class' => 'application.controllers.actions.UpdateAction',
				'model' => $model,
			),
			'register' => array(
				'class' => 'application.controllers.actions.RegisterAction',
				'model' => $model,
			),
			'gallery' => array(
				'class' => 'application.controllers.actions.GalleryAction',
				'model' => $model
			),
			'promo' => array(
				'class' => 'application.controllers.actions.PromoAction',
				'type' => $model::getEntityName(true),
			),
			'autocomplete' => array(
				'class' => 'application.controllers.actions.AutocompleteAction',
				'model' => $model
			),
			'like' => array(
				'class' => 'application.controllers.actions.LikeAction',
				'model' => $model
			),
			'unlike' => array(
				'class' => 'application.controllers.actions.UnlikeAction',
				'model' => $model
			),
            'follow' => array(
                'class' => 'application.controllers.actions.FollowAction',
                'model' => $model
            ),
            'unfollow' => array(
                'class' => 'application.controllers.actions.UnfollowAction',
                'model' => $model
            ),
		);
	}

	public function behaviors()
	{
		return array(
			'EntityControllerBehavior' => array(
				'class' => 'application.components.behaviors.EntityControllerBehavior',
				'dashboardAdditionalItems' => array(
					'brands' => array(
						'label' => 'Associate brands',
						'icon' => 'el-icon-tag',
					),
				)
			)
		);
	}

	/**
	 * Renders a page for brand association
	 *
	 * @param $id
	 * @throws CException
	 */
	public function actionBrands($id)
	{
		$this->layout = 'dashboard';
		$brandModel = new Brand;
		$storeModel = Store::model()->with('brands')->findByPk($id);

		$this->render('brands', array('model' => $storeModel, 'brandModel' => $brandModel));
	}

	/**
	 * Ajax associate brand to store
	 *
	 * @throws CException
	 */
	public function actionAssociateBrand()
	{
		if (Yii::app()->request->isAjaxRequest && !empty($_POST['Brand']))
		{
			$result = array('success' => false);

			try
			{
				$brand = Yii::app()->getRequest()->getParam('Brand');
				$storeModel = Store::model()->findByPk($brand['storeId']);

				if (isset($brand['add']) && !empty($brand['brandId']))
				{
					if ($storeModel->addBrandLink($brand['brandId']))
					{
						Yii::log(
								sprintf('Store "%s" was linked with brand "%s" by user "%s"', $brand['storeId'], $brand['brandId'], Yii::app()->user->getId()), CLogger::LEVEL_INFO
						);
						$result['success'] = true;
					}
					else
					{
						Yii::log(
								sprintf('Can\'t link store "%s" with brand "%s" by user "%s"', $brand['storeId'], $brand['brandId'], Yii::app()->user->getId()), CLogger::LEVEL_ERROR
						);
						throw new CException('Can\'t add link with brand.');
					}
				}
			}
			catch (Exception $e)
			{
				$result['message'] = $e->getMessage();
			}

			echo CJSON::encode($result);
			Yii::app()->end();
		}
	}

	/**
	 * Remove brand association
	 *
	 * @throws CException
	 */
	public function actionRemoveBrand()
	{
		if (Yii::app()->request->isAjaxRequest && !empty($_POST['Brand']))
		{
			$result = array('success' => false);
			try
			{
				$brand = Yii::app()->getRequest()->getParam('Brand');
				$storeModel = Store::model()->findByPk($brand['storeId']);

				if (isset($brand['remove']) && !empty($brand['brandId']))
				{
					if ($storeModel->deleteBrandLink($brand['brandId']))
					{
						Yii::log(
								sprintf('Store "%s" was unlinked with brand "%s" by user "%s"', $brand['storeId'], $brand['brandId'], Yii::app()->user->getId()), CLogger::LEVEL_INFO
						);
						$result['success'] = true;
					}
					else
					{
						Yii::log(
								sprintf('Can\'t unlink store "%s" with brand "%s" by user "%s"', $brand['storeId'], $brand['brandId'], Yii::app()->user->getId()), CLogger::LEVEL_ERROR
						);
						throw new CException('Can\'t delete link with brand.');
					}
				}
			}
			catch (Exception $e)
			{
				$result['message'] = $e->getMessage();
			}

			echo CJSON::encode($result);
			Yii::app()->end();
		}
	}
}
