<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	protected $_id;

	const ERROR_NOT_ACTIVED = 3;

	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$record = Users::model()->findByAttributes(array('email' => $this->username));
		if ($record === null)
		{
			$this->errorCode = self::ERROR_USERNAME_INVALID;
		}
		elseif(!$record->validatePassword($this->password))
		{
			$this->errorCode = self::ERROR_PASSWORD_INVALID;
		}
		elseif($record->status != 1)
		{
			$this->errorCode = self::ERROR_NOT_ACTIVED;
		}
		else
		{
			$this->afterAuthentication($record);
		}

		return !$this->errorCode;
	}

	public function getId(){
		return $this->_id;
	}

	protected function afterAuthentication(Users $user)
	{
		$this->_id = $user->id;
		$this->setState('username', $user->display_name);
		$this->setState('nickname', $user->nickname);
		$this->errorCode = self::ERROR_NONE;
	}

	public static function createAuthenticatedIdentity(Users $user)
	{
        $identity = new self($user->email,'');
		$identity->afterAuthentication($user);

        return $identity;
	}
}