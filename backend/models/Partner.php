<?php

namespace backend\models;

use yii\base\Model;

class Partner extends \yii\base\Model
{
    public $PartnerId; //980,
    public $Name; //"Кабышева Эльмира Жаскайратовна",
    public $Email; //"milliarder3756@gmail.com",
    public $Phone; //"+77785851151",
    public $BalanceWithdrawalBlocked; //false,
    public $RefBalanceWithdrawalBlocked; //false,
    public $AccountBlocked; //false,
    public $Rank; //1,
    public $RegistrationDate; //"1727827200"

    public function rules()
    {
        return [
            [['PartnerId', 'Rank', 'RegistrationDate'], 'integer'],
            [['Name', 'Email', 'Phone'], 'string'],
            [['BalanceWithdrawalBlocked', 'RefBalanceWithdrawalBlocked', 'AccountBlocked'], 'boolean'],
        ];
    }
}
