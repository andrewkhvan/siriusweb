<?php

namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use backend\models\OperationSearch;

class UserController extends \yii\web\Controller
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
                        'actions' => ['operations'],
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->identity->isAdmin;
                        },
                    ],
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
        $data = \backend\models\Api::request('operations', $searchParams);

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
            // 'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'pages' => $pages,
        ]);
    }
}
