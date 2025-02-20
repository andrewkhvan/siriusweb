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
        $result = Api::request($func = 'info');

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
        $result = Api::request($func = 'investments');

        return $this->render('investments', [
            'data' => $result,
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
        return $this->render('transactions');
    }

    public function actionWallet()
    {
        return $this->render('wallet');
    }

}
