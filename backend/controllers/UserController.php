<?php

namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use backend\models\OperationForm;
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
                        'actions' => ['operations', 'operation-view', 'operation-update', 'operation-create'],
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->identity->isAdmin;
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
        $searchParams = Yii::$app->request->queryParams;
        $data = Api::request('operations', $searchParams);

        $createForm = new OperationForm;

        // $searchModel = new OperationSearch;
        // $dataProvider = $searchModel->search($searchParams);
        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $data->rows,
            'pagination' => [
                'pageSize' => 50,
            ],
        ]);


        $pages = new \yii\data\Pagination([
            'defaultPageSize' => 50,
            'totalCount' => $data->total,
            'pageParam' => 'pageNo',
        ]);

        return $this->render('operations', [
            'createForm' => $createForm,
            'dataProvider' => $dataProvider,
            'pages' => $pages,
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

        return $this->redirect(['user/operations']);
    }

    public function actionOperationCreate($task = 'cashin')
    {
        if (! Yii::$app->request->isAjax) {
            return $this->redirect(['user/operations']);
        }

        $model = new OperationForm(['scenario' => $task]);

        $model->operation = $task;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            // return '<pre>'. print_r($model->attributes, true) .'</pre>';
            return $this->redirect(['user/operations']);
        }

        return $this->renderPartial('modal/op_create', [
            'model' => $model,
            'scenario' => $model->scenarios()[$task],
        ]);
    }
}
