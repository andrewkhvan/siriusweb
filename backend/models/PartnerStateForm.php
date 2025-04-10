<?php

namespace backend\models;

class PartnerStateForm extends Partner
{
    public function rules()
    {
        return [
            [['PartnerId'], 'integer'],
            [['BalanceWithdrawalBlocked', 'RefBalanceWithdrawalBlocked', 'AccountBlocked'], 'boolean'],
            [['BalanceWithdrawalBlocked', 'RefBalanceWithdrawalBlocked', 'AccountBlocked'], 'required'],
        ];
    }

    public function update()
    {
        $result = Api::request('savepartnerstate', $this->attributes);

        if ($result->HasError) {
            $this->addError($result->errorMessage);
            return false;
        }

        return true;
    }
}
