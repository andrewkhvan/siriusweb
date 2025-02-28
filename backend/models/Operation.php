<?php

namespace backend\models;

class Operation extends \yii\base\Model
{
    public $Date;
    public $DocNo;
    public $Status;
    public $Operation;
    public $DocSum;
    public $PartnerId;
    public $PartnerName;
    public $PartnerEmail;
    public $Investment;
    public $RefBalance;
    public $Virtual;
    public $WAddress;

    public function rules()
    {
        return [
            [['Date', 'DocNo', 'DocSum', 'PartnerId', 'Investment'], 'number'],
            [['Operation', 'PartnerName', 'PartnerEmail', 'WAddress'], 'string'],
            [['RefBalance', 'Virtual'], 'boolean'],
            [['Status'], 'save'],
        ];
    }

    public static function getFilterList()
    {
        return [
            1 => 'Пополнение',
            2 => 'Вывод',
            3 => 'Инвестиция',
        ];
    }

}