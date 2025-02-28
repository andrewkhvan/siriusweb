<?php

namespace backend\models;

use yii\data\ArrayDataProvider;

class OperationSearch extends Operation
{
    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ArrayDataProvider
     */
    public function search($params)
    {
        $data = Api::request('operations', $params);//print_r($data->rows);die;

        $dataProvider = new ArrayDataProvider([
            'allModels'=> $data->rows,
            // 'pagination' => [
            //     'defaultPageSize' => 50,
            //     'pageParam' => 'pageNo',
            // ],
            // 'totalCount' => $data->total,
        ]);

        return $dataProvider;
    }
}
