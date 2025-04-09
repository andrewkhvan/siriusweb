<?php

namespace backend\models\wallet;

use Yii;
use backend\models\Api;

class CashoutForm extends \yii\base\Model 
{
    public $wAddress;
    public $amount;
    public $refBalance;
    public $amountBalance;
    public $amountRefBalance;

    public function rules()
    {
        return [
            [['amount', 'wAddress'], 'required'],
            [['amount'], 'integer', 'min' => 100],
            [['amount'], 'validateAmount'],
            [['wAddress'], 'string'],
            [['refBalance'], 'boolean'],
        ];
    }

    public function validateAmount($attribute, $params)
    {
        if ($this->refBalance && $this->amount > $this->amountRefBalance ) {
            $this->addError($attribute, Yii::t('app', 'Amount must be no greater than {max}.', [
                'max' => $this->amountRefBalance,
            ]));
        }

        if ($this->refBalance == false && $this->amount > $this->amountBalance ) {
            $this->addError($attribute, Yii::t('app', 'Amount must be no greater than {max}.', [
                'max' => $this->amountBalance,
            ]));
        }
    }

    public function apiSend()
    {
        $this->refBalance = (bool) $this->refBalance;
        return Api::request('cashout', $this->attributes);
    }

    public function attributeLabels()
    {
        return [
            'amount' => Yii::t('app', 'Amount'),
            'wAddress' => Yii::t('app', 'Wallet address'),
            'refBalance' => Yii::t('app', 'Referral balance'),
        ];
    }

    public static function getBalanceList()
    {
        return [
            0 => Yii::t('app', 'Main balance'),
            1 => Yii::t('app', 'Referral balance'),
        ];
    }
}
