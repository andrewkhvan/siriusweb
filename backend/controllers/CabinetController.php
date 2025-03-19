<?php

namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use backend\models\Api;
use backend\models\Transaction;
use backend\models\InvestForm;;

class CabinetController extends BaseController
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

    public function actionIndexChart()
    {
        if (! Yii::$app->request->isAjax) {
            throw new \yii\web\BadRequestHttpException;
            exit;
        }

        $chart = new \backend\models\ApexChart;
        $data = $chart->apiLoad();

        return json_encode($data);
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

    public function actionInvestOpen($id)
    {
        $data = Api::request($func = 'investments');

        $model = new \backend\models\InvestForm;

        //get investment by id
        $invest = null;
        foreach ($data->rows as $item) {
            if ($item->Id == $id) {
                $model->attributes = (array) $item;
                break;
            }
        }

        $model->balance = $data->balance;
        unset($data);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $result = $model->apiSend();
            if ($result->HasError) {
                $model->addError('Amount', $result->errorMessage);
            } else {
                return '<p class="text-success text-center">'
                    . Yii::t('app', 'Request sent')
                    . '<br><br><button class="btn btn-success" data-bs-dismiss="modal">'
                    . Yii::t('app', 'Close')
                    . '</button></p>';
            }
        }

        return $this->renderPartial('invest_open', [
            'model' => $model,
        ]);
    }

    public function actionPromo()
    {
        return $this->render('promo');
    }

    public function actionTeam()
    {
        $info = new \backend\models\Dashboard;
        $info->apiLoad();

        $data = Api::request('tree');

        return $this->render('team', [
            'info' => $info,
            'data' => $data,
        ]);
    }

    public function actionTeamSubgroup()
    {
        if (Yii::$app->request->isAjax) {
            $partner_id = (int) Yii::$app->request->post('partner_id');

            $data = Api::request('tree', ['PartnerId' => $partner_id]);
            return $this->renderPartial('team_subgroup', [
                'data' => $data,
            ]);
        }

        return new \yii\web\BadRequestHttpException();
    }

    public function actionTransactions()
    {
        $params = $this->request->queryParams;

        $data = Api::request('transactions', $params);

        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $data->rows,
        ]);

        $pages = new \yii\data\Pagination([
            'totalCount' => $data->total,
            'defaultPageSize' => 50,
            'pageParam' => 'pageNo',
        ]);

        return $this->render('transactions', [
            'dataProvider' => $dataProvider,
            'pages' => $pages,
        ]);
    }

    public function actionWallet()
    {
        $data = Api::request('wallet');

        $model = new \backend\models\wallet\CashoutForm;

        $model->amountBalance = $data->Balance;
        $model->amountRefBalance = $data->RefBalance;
        $model->wAddress = $data->WAddress;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $result = $model->apiSend();
            if ($result->HasError) {
                Yii::$app->session->setFlash('error', $result->errorMessage);
            } else {
                Yii::$app->session->setFlash('success', 'Request sent');
            }
        }

        return $this->render('wallet', [
            'data' => $data,
            'model' => $model,
        ]);
    }

}
