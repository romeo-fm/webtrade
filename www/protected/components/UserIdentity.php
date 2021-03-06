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
    public function authenticate() {
        $usersModel = Users::model();
        $user = $usersModel->findByAttributes(array('varName'=> $this->name, 'isActive' => 1));
        if(!$user) {
            $this->errorCode=self::ERROR_USERNAME_INVALID;
        } else if (!$user->validatePassword($this->password)) {
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
        } else {
            $this->_id = $user->intUserID;
            $this->setState('username', $user->varName);
            $this->setState('isAdmin', $user->isAdmin);
            $this->errorCode=self::ERROR_NONE;
        }

        return !$this->errorCode;
    }

    public function getId(){
        return $this->_id;
    }
}