<?php

namespace backend\models;

use Yii;
use yii\base\Model;

class OperationSetForm extends Model
{
    public $docNo;
    public $status;

    public function rules()
    {
        return [
            [['docNo'], 'integer'],
            [['status'], 'string'],
        ];
    }

    public function update()
    {
        if ($this->validate()) {
            $result = Api::request('setoperation', $this->attributes);
            if ($result->HasError) {
                Yii::$app->session->setFlash('error', $result->errorMessage);
            } else {
                return true;
            }
        }
        return false;
    }
}