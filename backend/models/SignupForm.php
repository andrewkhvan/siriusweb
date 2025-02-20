<?php

namespace backend\models;

use Yii;
use yii\base\Model;

class SignupForm extends Model
{
    public $email;
    public $phone;
    public $country;
    public $city;
    public $mentor_email;
    public $password;
    public $password_repeat;

    public function rules()
    {
        return [
            [['email', 'password', 'password_repeat', 'mentor_email'], 'required'],
            [['email', 'mentor_email'], 'email'],
            [['email', 'phone', 'country', 'city', 'mentor_email', 'password', 'password_repeat'], 'string'],
        ];
    }

}
