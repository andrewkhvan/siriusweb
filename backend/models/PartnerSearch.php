<?php

namespace backend\models;

use yii\data\ArrayDataProvider;
use yii\data\Pagination;

class PartnerSearch extends Partner
{
    public $pageNo;

    public function rules()
    {
        return [
            [['PartnerId', 'Rank', 'pageNo'], 'integer'],
            [['Name', 'Email', 'Phone'], 'string'],
            [['BalanceWithdrawalBlocked', 'RefBalanceWithdrawalBlocked', 'AccountBlocked'], 'boolean'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'BalanceWithdrawalBlocked' => 'Balance Blocked',
            'RefBalanceWithdrawalBlocked' => 'Ref.Balance Blocked',
            'RegistrationDate' => 'Reg. Date',
        ];
    }

    public function search()
    {
        $data = Api::request('getpartnersadmin', $this->attributes);

        $dataProvider = new ArrayDataProvider([
            'allModels'=> $data->rows,
            'pagination' => [
                'pageSize' => 50,
            ],
        ]);

        $pages = new Pagination([
            'defaultPageSize' => 50,
            'totalCount' => $data->total,
            'pageParam' => 'pageNo',
        ]);

        return [
            'dataProvider' => $dataProvider,
            'pages' => $pages,
        ];
    }
}
