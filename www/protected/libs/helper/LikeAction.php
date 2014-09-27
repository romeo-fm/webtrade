<?php

class LikeAction extends CAction
{
	public $model;

	public function run()
	{
		$requestData = ApplicationPlugin::getRequestData(array('id'));

		try
		{
			$model = $this->model;
			$model->id = $requestData->id;

			$isSaved = $model->like(Yii::app()->user->getId());

			$result = array('success' => $isSaved);
		} catch (Exception $ex)
		{
			$result = array('success' => false,'error' => $ex->getMessage());
		}

		ApplicationPlugin::sendAjaxResponse($result);
    }
}