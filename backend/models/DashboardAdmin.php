<?php

namespace backend\models;

class DashboardAdmin extends Dashboard
{
    public $BalanceWithdrawalBlocked;
    public $RefBalanceWithdrawalBlocked;
    public $AccountBlocked;

    public function rules()
    {
        $rules = parent::rules();
        $rules[] = [['BalanceWithdrawalBlocked', 'RefBalanceWithdrawalBlocked', 'AccountBlocked'], 'boolean'];

        return $rules;
    }

    public function apiLoad($apifunction = 'infoadmin', $partnerId = null)
    {
        $result = parent::apiLoad($apifunction, $partnerId);

        $this->BalanceWithdrawalBlocked = $result->BalanceWithdrawalBlocked;
        $this->RefBalanceWithdrawalBlocked = $result->RefBalanceWithdrawalBlocked;
        $this->AccountBlocked = $result->AccountBlocked;

        return $result;
    }
}
