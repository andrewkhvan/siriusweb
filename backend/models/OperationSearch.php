<?php

namespace backend\models;

use yii\data\ArrayDataProvider;
use yii\data\Pagination;

class OperationSearch extends Operation
{
    public $pageNo;

    public function rules()
    {
        return [
            [['DocNo', 'Status', 'Operation'], 'safe'],
            [['pageNo', 'DocSum'], 'integer'],
            [['PartnerName', 'PartnerEmail', 'WAddress'], 'string'],
            [['RefBalance', 'Virtual'], 'boolean'],
        ];
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @return ArrayDataProvider
     */
    public function search()
    {
        $data = Api::request('operations', $this->attributes);

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
