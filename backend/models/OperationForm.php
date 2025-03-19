<?php
namespace backend\models;

use Yii;

class OperationForm extends \yii\base\Model
{
    const SCENARIO_CASHIN = 'cashin';
    const SCENARIO_CASHOUT = 'cashout';
    const SCENARIO_INVESTMENT = 'investment';

    public $operation;
    public $email;
    public $investmentId;
    public $wAddress;
    public $amount;
    public $refBalance;
    public $virtual;
    public $status;

    public function rules()
    {
        $rules = [
            [['operation'], 'string'],
            [['amount', 'investmentId'], 'integer'],
            [['email'], 'email'],
            [['refBalance', 'virtual'], 'boolean'],
            [['email', 'amount'], 'required'],
            [['wAddress'], 'required', 'on' => ['cashin']],
            [['wAddress', 'refBalance'], 'required', 'on' => ['cashout']],
            [['investmentId', 'virtual'], 'required', 'on' => ['investment']],
        ];

        return $rules;
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_CASHIN] = ['email', 'amount', 'status', 'wAddress'];
        $scenarios[self::SCENARIO_CASHOUT] = ['email', 'amount', 'status', 'refBalance', 'wAddress'];
        $scenarios[self::SCENARIO_INVESTMENT] = ['email', 'amount', 'status', 'investmentId', 'virtual'];

        return $scenarios;
    }

    public function attributeLabels()
    {
        return [
            'investmentId' => Yii::t('app', 'Investment'),
            'wAddress' => Yii::t('app', 'Wallet Address'),
            'amount' => 'Amount',
            'refBalance' => Yii::t('app', 'Ref. balance'),
            'virtual' => Yii::t('app', 'Virtual'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    public function save()
    {
        if ($this->validate()) {
            $result = Api::request('newoperation', $this->attributes);

            if ($result->HasError) {
                $this->addError('Status', $result->errorMessage);

                return false;
            }

            return true;
        }

        return false;
    }
}
