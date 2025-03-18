<?php

namespace backend\models;

use yii\base\InvalidArgumentException;
use yii\base\Model;
use Yii;

/**
 * Password reset form
 */
class ResetPasswordForm extends Model
{
    public $token;
    public $password;
    public $password_hash;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['token', 'string'],
            ['password', 'required'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],
        ];
    }

    /**
     * Finds out if password reset token is active
     *
     * @param string $token password reset token
     * @return bool
     */
    public function isTokenNotExpired()
    {
        if (empty($this->token)) {
            Yii::$app->session->setFlash('error', Yii::t('auth', 'Password reset token cannot be blank.'));
            return false;
        }
        
        $timestamp = (int) substr($this->token, strrpos($this->token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        
        if ($timestamp + $expire < time()) {
            Yii::$app->session->setFlash('error', Yii::t('auth', 'Password reset token expired.'));
            return false;
        }

        return true;
    }

    /**
     * Resets password.
     *
     * @return bool if password was reset.
     */
    public function resetPassword()
    {
        $this->password_hash = User::getPasswordHash($this->password);
        $result = Api::requestAuth('finishresetpwd', [
            'newpassword' => $this->password_hash,
            'resetpwdtoken' => $this->token,
        ]);

        if ($result->HasError) {
            $this->addError('password', $result->Message);
            return false;
        }

        Yii::$app->session->setFlash('success', Yii::t('auth', 'New password saved.'));

        return true;
    }
}
