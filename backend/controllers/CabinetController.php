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

        if (isset($params['filter'])) {
            $params['filter'] = (int) $params['filter'];
        }

        $data = Api::request('transactions', $params);

        $pages = new \yii\data\Pagination([
            'totalCount' => $data->total,
            'defaultPageSize' => 50,
            'pageParam' => 'pageNo',
        ]);

        return $this->render('transactions', [
            'data' => $data,
            'pages' => $pages,
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
