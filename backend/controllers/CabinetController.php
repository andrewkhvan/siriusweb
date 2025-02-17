<?php

namespace backend\controllers;

use Yii;
use backend\models\Api;

class CabinetController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $data = new Api;
        $result = $data->request($func = 'info');

        return $this->render('index', [
            'data' => $result,
        ]);
    }

    public function actionDeposits()
    {
        return $this->render('deposits');
    }

    public function actionInvestments()
    {
        return $this->render('investments');
    }

    public function actionPromo()
    {
        return $this->render('promo');
    }

    public function actionTeam()
    {
        return $this->render('team');
    }

    public function actionTransactions()
    {
        return $this->render('transactions');
    }

    public function actionWallet()
    {
        return $this->render('wallet');
    }

}
