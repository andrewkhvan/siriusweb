<?php

namespace backend\models;

use Yii;
use yii\base\Model;

class Transaction extends Model
{
    public $Date;
    public $Operation;
    public $Bonus;
    public $Sum;
    public $refPartner;

    public function rules()
    {
        return [
            [['Date', 'Operation', 'Bonus', 'Sum', 'refPartner'], 'save'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'Date' => Yii::t('app', 'date'),
            'Operation' => Yii::t('app', 'Operation'),
            'Bonus' => Yii::t('app', 'Bonus'),
            'Sum' => Yii::t('app', 'Sum'),
            'refPartner' => Yii::t('app', 'refPartner'),
        ];
    }

    public static function getFilterList()
    {
        return [
            1 => Yii::t('app', 'Dividend accrual'),
            2 => Yii::t('app', 'Direct Bonus'),
            3 => Yii::t('app', 'Income by Level'),
            4 => Yii::t('app', 'Rank Bonus'),
            5 => Yii::t('app', 'Withdrawal'),
            6 => Yii::t('app', 'Replenishment'),
            7 => Yii::t('app', 'Investment'),
        ];
    }
}
