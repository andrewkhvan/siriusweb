<?php

namespace backend\models;

use yii\base\Model;

class Partner extends \yii\base\Model
{
    public $PartnerId;
    public $Name;
    public $Email;
    public $Phone;
    public $BalanceWithdrawalBlocked;
    public $RefBalanceWithdrawalBlocked;
    public $AccountBlocked;
    public $Rank;
    public $RegistrationDate;

    public function rules()
    {
        return [
            [['PartnerId', 'Rank', 'RegistrationDate'], 'integer'],
            [['Name', 'Email', 'Phone'], 'string'],
            [['BalanceWithdrawalBlocked', 'RefBalanceWithdrawalBlocked', 'AccountBlocked'], 'boolean'],
        ];
    }
}
