<?php

namespace backend\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read User|null $user
 *
 */
class LoginForm extends Model
{
    public $email;
    public $password;
    public $rememberMe = true;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // email and password are both required
            [['email', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }


    public function attributeLabels()
    {
        return [
            'rememberMe' => Yii::t('auth', 'Remember Me'),
            'password' => Yii::t('auth', 'Password'),
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $auth = Api::auth($this->email, User::getPasswordHash($this->password));

            if ($auth->HasError) {
                // $this->addError($attribute, 'Incorrect username or password.');
                $this->addError($attribute, $auth->Message);
            } else {
                Yii::$app->session->set('session_id', $auth->SessionId);
            }


            // $user = $this->getUser();

            // if (!$user || !$user->validatePassword($this->password)) {
            //     $this->addError($attribute, 'Incorrect username or password.');
            // }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            Yii::$app->session->set('lang', $this->getUser()->language);
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
        }
        return false;
    }

    /**
     * Finds user by [[api]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByApiRequest();
        }

        return $this->_user;
    }
}
