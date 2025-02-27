<?php

namespace backend\models;

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
            1 => 'Начисление дивидендов',
            2 => 'Direct Bonus',
            3 => 'Доход от дохода',
            4 => 'Ранговый бонус',
            5 => 'Вывод',
            6 => 'Пополнение',
            7 => 'Инвестиция',
        ];
    }
}
