<?php
class ApplicationPlugin
{
	const wrong_request_error = 'Page not found';
	const bad_request_error = 'Bad request';
	const db_error = 'Error while saving data';

	const error_messages_key = 'error';
	const success_messages_key = 'success';

	public static function getRequestData(array $requestParamsFields, $checkIsAjaxRequest = true)
	{
		$requestData = new stdClass;

		if($checkIsAjaxRequest && !Yii::app()->request->isAjaxRequest)
		{
			self::throwNotFoundError();
		}

		foreach($requestParamsFields as $requestParamKey => $requestParamField)
		{
			$isParamRequired = ($requestParamField !== false);
			if(is_bool($requestParamField))
			{
				$requestParamField = $requestParamKey;
			}

			$_requestParamData = Yii::app()->request->getParam($requestParamField);
			if($isParamRequired && !$_requestParamData)
			{
				self::throwBadRequestError();
			}

			$requestData->$requestParamField = $_requestParamData;
		}

		return $requestData;
	}

	public static function sendAjaxResponse(array $responseData)
	{
		//header('Content-type: application/json');
		//echo CJavaScript::jsonEncode($responseData);
        echo CJSON::encode($responseData);
		Yii::app()->end();
	}

	public static function throwNotFoundError($text = null)
	{
		$message = isset($text) ? $text : ApplicationPlugin::wrong_request_error;
		throw new CHttpException(404, Yii::t('app', $message));
	}

	public static function throwBadRequestError($text = null)
	{
		$message = isset($text) ? $text : ApplicationPlugin::bad_request_error;
		throw new CHttpException(400, Yii::t('app', $message));
	}

	public static function getErrorMessage($messageKey)
	{
		$errorMessages = Yii::app()->user->getFlash(self::error_messages_key);

		$errorMessage = isset($errorMessages[$messageKey]) ? $errorMessages[$messageKey] : null;

		return $errorMessage;
	}

	public static function getErrorMessages()
	{
		$errorMessagesFromFlash = Yii::app()->user->getFlash(self::error_messages_key);
		$errorMessages = is_array($errorMessagesFromFlash) ? $errorMessagesFromFlash : array();

		return $errorMessages;
	}

	public static function getSuccessMessage($messageKey)
	{
		$successMessages = Yii::app()->user->getFlash(self::success_messages_key);

		$successMessage = isset($successMessages[$messageKey]) ? $successMessages[$messageKey] : null;

		return $successMessage;
	}

	public static function getSuccessMessages()
	{
		$successMessagesFromFlash = Yii::app()->user->getFlash(self::success_messages_key);
		$successMessages = is_array($successMessagesFromFlash) ? $successMessagesFromFlash : array();

		return $successMessages;
	}

	public static function addErrorMessage($errorMessage, $messageKey = null)
	{
		self::addMessage($errorMessage, self::error_messages_key, $messageKey);
	}

	public static function addSuccessMessage($successMessage, $messageKey = null)
	{
		self::addMessage($successMessage, self::success_messages_key, $messageKey);
	}

	public static function addMessage($message,$keyForMessages,$keyForMessage = null)
	{
		$messagesFromFlash = Yii::app()->user->getFlash($keyForMessages);
		$messages = is_array($messagesFromFlash) ? $messagesFromFlash : array();

		if($keyForMessage)
		{
			$messages[$keyForMessage] = $message;
		}
		else
		{
			$messages[] = $message;
		}

		Yii::app()->user->setFlash($keyForMessages, $messages);
	}
}