<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use backend\models\User;

/**
 * Password reset request form
 */
class PasswordResetRequestForm extends Model
{
    public $email;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
        ];
    }

    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return bool whether the email was send
     */
    public function sendEmail()
    {
        $token = User::generatePasswordResetToken();
        $result = Api::requestAuth('startresetpwd', [
            'email' => $this->email,
            'resetPwdToken' => $token,
        ]);

        if ($result->HasError) {
            $this->addError('email', $result->Message);
            return false;
        }

        return true;
    }
}
