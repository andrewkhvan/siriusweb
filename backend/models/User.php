<?php

namespace backend\models;

use Yii;
use yii\helpers\Url;

class User extends \yii\base\BaseObject implements \yii\web\IdentityInterface
{
    public $id;
    public $email;
    public $username;
    public $fullName;
    public $password;
    public $authKey;
    public $accessToken;
    public $rank;
    public $isAdmin;
    public $balance;
    public $ref_balance;

    private static $users = [
        '100' => [
            'id' => '100',
            'username' => 'admin',
            'password' => 'admin',
            'authKey' => 'test100key',
            'accessToken' => '100-token',
        ],
        '101' => [
            'id' => '101',
            'username' => 'demo',
            'password' => 'demo',
            'authKey' => 'test101key',
            'accessToken' => '101-token',
        ],
    ];


    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findByApiRequest();
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findByApiRequest();

        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findByApiRequest();

        foreach (self::$users as $user) {
            if (strcasecmp($user['username'], $username) === 0) {
                return new static($user);
            }
        }

        return null;
    }

    public static function findByApiRequest()
    {
        $user = Yii::$app->session->get('user');

        if ($user) {
            return new static($user);
        }

        $data = Api::request('partner');

        if (is_object($data) && !isset($data->HasError)) {
            $user = [
                'id' => $data->PartnerId,
                'email' => $data->Email,
                'username' => $data->Email,
                'fullName' => $data->Name,
                'rank' => $data->Rank,
                'balance' => $data->Balance,
                'ref_balance' => $data->RefBalance,
                'authKey' => md5('authKey_' . $data->PartnerId),
                'accessToken' => md5('accessToken_' . $data->PartnerId),
                'isAdmin' => $data->IsAdmin,
            ];
            // Yii::$app->session->set('user', $user);

            return new static($user);
        }

        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }

    public static function getPasswordHash($pass)
    {
        return hash('sha256', $pass);
    }

    public function getAvatarUrl()
    {
        return '/images/users/user-dummy-img.jpg';
    }

    public function getRankTitle()
    {
        return 'Rank-' . $this->rank;
    }

    public static function getRefLink()
    {
        return Url::to(['auth/signup', 'ref' => Yii::$app->user->identity->email], 'https');
    }
    public static function getRawRefLink()
    {
        return 'https://' . Yii::$app->request->hostName .'/auth/signup?ref='. Yii::$app->user->identity->email;
    }

    /**
     * Generates new password reset token
     */
    public static function generatePasswordResetToken()
    {
        return Yii::$app->security->generateRandomString() . '_' . time();
    }

}
