<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use backend\models\User;

class SignupForm extends Model
{
    public $email;
    public $name;
    public $phone;
    public $photo;
    public $countryCode;
    public $city;
    public $sponsorEmail;
    public $password;
    public $password_repeat;
    public $language;

    public function rules()
    {
        return [
            [['email', 'name', 'password', 'password_repeat', 'sponsorEmail', 'phone'], 'required'],
            [['email', 'sponsorEmail'], 'email'],
            [['phone', 'photo', 'name', 'city', 'password', 'password_repeat', 'language'], 'string'],
            [['countryCode'], 'string', 'min' => 2, 'max' => 3],
            [['password'], 'string', 'min' => 6],
            [['password_repeat'], 'passCompare'],
        ];
    }

    public function passCompare($attribute, $params)
    {
        if ($this->password !== $this->password_repeat) {
            $this->addError($attribute, Yii::t('auth', "Passwords don't match"));
        }
    }

    public function registerUser()
    {
        $this->password = User::getPasswordHash($this->password);
        return Api::register($this->attributes);
    }

    public function attributeLabels()
    {
        return [
            'name' => Yii::t('auth', 'Enter Name'),
            'email' => Yii::t('auth', 'Enter email'),
            'password' => Yii::t('auth', 'Enter password'),
            'password_repeat' => Yii::t('auth', 'Repeat password'),
            'countryCode' => Yii::t('auth', 'Enter Country'),
            'city' => Yii::t('auth', 'Enter City'),
            'phone' => Yii::t('auth', 'Enter Phone'),
            'photo' => Yii::t('auth', 'Enter Photo'),
            'sponsorEmail' => Yii::t('auth', 'Sponsor email'),
            'language' => Yii::t('auth', 'Language'),
        ];
    }

    public static function getLangList()
    {
        return Lang::getList();
    }

    public static function getCountryList()
    {
        $result = Api::requestAuth('getcountries');
        if (isset($result->rows)) {
            $langs = [];
            foreach ($result->rows as $lang) {
                $langs[strtolower($lang->Code)] = $lang->Name;
            }
            sort($langs);
            return $langs;
        }

        return [
            'KZ' => 'Kazakhstan',
            'US' => 'United States',
        ];
    }
}
