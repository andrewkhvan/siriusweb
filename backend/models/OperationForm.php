<?php
namespace backend\models;

class OperationForm extends Operation
{
    public function rules()
    {
        $rules = parent::rules();
        $rules[] = [['PartnerEmail'], 'required'];
        $rules[] = [['PartnerEmail'], 'email'];

        return $rules;
    }
}
