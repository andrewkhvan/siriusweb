<?php

namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use backend\models\Api;

class CabinetController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        // $data = Api::request($func = 'info');
        $data = new \backend\models\Dashboard;

        $data->apiLoad();

        return $this->render('index', [
            'data' => $data,
        ]);
    }

    public function actionDeposits()
    {
        $data = Api::request($func = 'deposits');

        return $this->render('deposits', [
            'data' => $data,
        ]);
    }

    public function actionInvestments()
    {
        $data = Api::request($func = 'investments');

        return $this->render('investments', [
            'data' => $data,
        ]);
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
        $data = Api::request('transactions', ['pageNo' => 1]);

        return $this->render('transactions', [
            'data' => $data
        ]);
    }

    public function actionWallet()
    {
        $data = Api::request('wallet');

        return $this->render('wallet', [
            'data' => $data,
        ]);
    }

}
