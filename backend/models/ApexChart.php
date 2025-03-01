<?php

namespace backend\models;

use yii\base\Model;

class ApexChart extends Model
{
    public $data;

    public function apiLoad()
    {
        $result = Api::request('getbonusstat');

        $data = [];
        foreach ($result->rows as $row) {
            $data['month'][] = date('M', $row->Month);
            $data['bonus'][] = $row->Bonus;
        }

        return $data;
    }
}
