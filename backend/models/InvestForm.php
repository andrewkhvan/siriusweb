<?php

namespace backend\models;

use Yii;

class InvestForm extends \yii\base\Model
{
    public $Id;
    public $InvestmentName;
    public $Amount;
    public $Profitability;
    public $Threshold;
    public $UpperThreshold;
    public $Remainder;
    public $balance;
    public $refbalance;

    public function rules()
    {
        return [
            [['InvestmentName'], 'string'],
            [['Id', 'Amount', 'Profitability', 'Threshold', 'UpperThreshold', 'Remainder'], 'integer'],
            [['Amount'], 'required'],
            [['Amount'], 'validateAmount'],
            [['Amount'], 'validateBalance'],
        ];
    }

    public function validateAmount($attribute, $params)
    {
        if ($this->Amount < $this->Threshold) 
        $this->addError($attribute, Yii::t('app', 'Amount must be no less than {min}.', [
            'min' => $this->Threshold,
        ]));

        if ($this->UpperThreshold != 0 && $this->Amount > $this->UpperThreshold) 
        $this->addError($attribute, Yii::t('app', 'Amount must be no greater than {max}.', [
            'max' => $this->UpperThreshold,
        ]));
    }

    public function validateBalance($attribute, $params)
    {
        if ($this->getTotal() < $this->Amount) 
        $this->addError($attribute, Yii::t('app', 'Insufficient funds'));
    }

    public function apiSend()
    {
        return Api::request('invest', [
            'InvestmentId' => $this->Id,
            'Amount' => $this->Amount,
        ]);
    }

    public function getUpperThreshold()
    {
        if ($this->UpperThreshold == 0) {
            return Yii::t('app', 'unlimited amount');
        }
        return $this->UpperThreshold . ' USDT';
    }

    public function getTotal()
    {
        return $this->balance + $this->refbalance;
    }
}
