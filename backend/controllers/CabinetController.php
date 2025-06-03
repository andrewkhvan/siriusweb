<?php

namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\helpers\Url;
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

        $partner = Api::request('partner');
        $country = null;
        if (is_object($partner)) {
            if (isset($partner->country)) {
                $country = $partner->country;
            } elseif (isset($partner->Country)) {
                $country = $partner->Country;
            }
        }

        return $this->render('index', [
            'data' => $data,
            'country' => $country,
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

    public function actionDepositsPdf($id)
    {
        $id = (int) $id;
        $depos = Api::request($func = 'deposits');
        $depo = $depos->rows[$id];

        $content = $this->renderPartial('deposits_agreement', [
            'cur_date' => date('Y-m-d H:i:s'),
            'start_date' => date('Y-m-d H:i:s', $depo->OpenDate),
            'fio' => Yii::$app->user->identity->fullName,
            'deposit_summ' => $depo->Investment,
            'deposit_name' => $depo->InvestmentName,
            'partner_sign' => 'images/users/sign/blank.png',
        ]);

        $pdf = new \kartik\mpdf\Pdf([
            'format' => \kartik\mpdf\Pdf::FORMAT_A4,
            'orientation' => \kartik\mpdf\Pdf::ORIENT_PORTRAIT,
            'destination' => \kartik\mpdf\Pdf::DEST_BROWSER,
            'cssFile' => '@webroot/css/pdf.css',
            'filename' => 'Investment_Agreement_Sirius_'.Yii::$app->user->identity->fullName.'_'.$depo->InvestmentName.'.pdf',
            'content' => $content,
        ]);

        return $pdf->render();
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
        if (! Yii::$app->request->isAjax) {
            return $this->redirect(['cabinet/investments']);
        }

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
        $model->refbalance = $data->refbalance;
        unset($data);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $result = $model->apiSend();
            if ($result->HasError) {
                $model->addError('Amount', $result->errorMessage);
            } else {
                Yii::$app->session->setFlash('success', Yii::t('app', 'Request sent'));
                return $this->redirect(['cabinet/deposits']);
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
        Url::remember();

        $params = $this->request->queryParams;

        $data = Api::request('transactions', $params);

        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $data->rows,
            'pagination' => [
                'pageSize' => 50,
            ],
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

    public function actionTransactionCancel($docNo)
    {
        if (Yii::$app->request->isPost) {
            Transaction::cancel($docNo);
        }

        return $this->goBack();
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
                Yii::$app->session->setFlash('success', Yii::t('app', 'Request sent'));
            }
        }

        return $this->render('wallet', [
            'data' => $data,
            'model' => $model,
        ]);
    }

    public function actionWalletUpdate()
    {
        if (!Yii::$app->request->isAjax) {
            throw new \yii\web\BadRequestHttpException();
            exit;
        }

        //send PIN request on popup open
        if (!Yii::$app->request->isPost) {
            $result = Api::request('startchangewaddress');
            if ($result->HasError) {
                return "<p class=\"text-bg-danger p-2 rounded\">{$result->ErrorMessage}</p>";
            }
        }

        $model = new \backend\models\wallet\WalletAddressForm;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $result = $model->changeAddr();

            if ($result->HasError) {
                Yii::$app->session->setFlash('error', $result->errorMessage);
            } else {
                Yii::$app->session->setFlash('success', Yii::t('app', 'Wallet Address changed.'));
            }
            return $this->redirect(['cabinet/wallet']);
        }

        return $this->renderPartial('wallet_update', [
            'model' => $model,
        ]);
    }

}
