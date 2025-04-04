<?php

namespace backend\models\wallet;

use Yii;
use yii\base\Model;
use backend\models\Api;

class WalletAddressForm extends Model
{
    public $newwaddress;
    public $pin;

    public function rules()
    {
        return [
            [['newwaddress'], 'required'],
            [['newwaddress'], 'string', 'max' => 34],
            [['pin'], 'required'],
            [['pin'], 'integer', 'min' => 0],
        ];
    }

    public function attributeLabels()
    {
        return [
            'newwaddress' => Yii::t('app', 'Wallet Address'),
            'pin' => Yii::t('app', 'PIN Code'),
        ];
    }

    public function changeAddr()
    {
        return Api::request('finishchangewaddress', $this->attributes);
    }
}
