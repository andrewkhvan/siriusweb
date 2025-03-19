<?php

namespace backend\models;

use yii\base\Model;

class VerifyEmailForm extends Model
{
    /**
     * @var string
     */
    public $token;

    public function rules()
    {
        return [
            [['token'], 'required'],
            [['token'], 'string'],
            [['token'], 'skipOnEmpty' => false],
        ];
    }

    /**
     * Verify email
     *
     * @return User|null the saved model or null if saving fails
     */
    public function verifyEmail()
    {
        $result = Api::requestAuth('emailverification', [
            'emailVerificationToken' => $this->token,
        ]);

        return !$result->HasError;
    }
}
