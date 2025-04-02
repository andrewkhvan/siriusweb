<?php

namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use backend\models\OperationForm;
use backend\models\OperationSearch;
use backend\models\OperationSetForm;
use backend\models\Api;

class UserController extends BaseController
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'update'],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['operations', 'operation-view', 'operation-update', 'operation-create', 'partner-detail'],
                        'matchCallback' => function ($rule, $action) {
                            if (isset(Yii::$app->user->identity->isAdmin)) {
                                return Yii::$app->user->identity->isAdmin;
                            }
                            return false;
                        },
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'operation-update' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionUpdate()
    {
        return $this->render('update');
    }

    public function actionOperations()
    {
        Url::remember();

        $createForm = new OperationForm;
        $searchParams = Yii::$app->request->queryParams;

        $searchModel = new OperationSearch;
        $searchModel->load($searchParams);
        $searchModel->pageNo = Yii::$app->request->get('pageNo');
        $searchResult = $searchModel->search();

        return $this->render('operations', [
            'createForm' => $createForm,
            'searchModel' => $searchModel,
            'dataProvider' => $searchResult['dataProvider'],
            'pages' => $searchResult['pages'],
        ]);
    }

    public function actionOperationView()
    {
        if (! Yii::$app->request->isAjax) {
            throw new \yii\web\BadRequestHttpException;
            exit;
        }

        $docno = Yii::$app->request->post('docnum');
        $data = Api::request('getoperation', ['docno' => (int) $docno]);

        return $this->renderPartial('modal/op_view', [
            'data' => $data,
        ]);
    }

    public function actionOperationUpdate($docno = null, $status)
    {
        if (empty($docno)) {
            Yii::$app->session->setFlash('warning', 'Operation number not set');
            return $this->redirect(['user/operations']);
        }

        $model = new OperationSetForm(['docNo' => $docno, 'status' => $status]);
        if ($model->update()) {
            Yii::$app->session->setFlash('success', Yii::t('app', 'Operation updated'));
        }

        return $this->goBack();
    }

    public function actionOperationCreate($task = 'cashin')
    {
        if (! Yii::$app->request->isAjax) {
            return $this->redirect(['user/operations']);
        }

        $model = new OperationForm(['scenario' => $task]);

        $model->operation = $task;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->goBack();
        }

        return $this->renderPartial('modal/op_create', [
            'model' => $model,
            'scenario' => $model->scenarios()[$task],
        ]);
    }

    public function actionPartnerDetail($partnerId)
    {
        //user info
        $info = new \backend\models\Dashboard;
        $info->apiLoad('infoadmin', $partnerId);

        // deposits
        $deposits = Api::request('depositsadmin', ['partnerId' => $partnerId]);

        // transactions
        $searchParams = Yii::$app->request->queryParams;
        $data = Api::request('transactionsadmin', $searchParams);

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

        return $this->render('partner_detail', [
            'info' => $info,
            'deposits' => $deposits,
            'dataProvider' => $dataProvider,
            'pages' => $pages,
        ]);
    }
}
