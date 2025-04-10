<?php

namespace backend\controllers;

use Yii;
use yii\helpers\Url;
use yii\filters\AccessControl;
use backend\models\PartnerSearch;

class PartnerController extends BaseController
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'matchCallback' => function ($rule, $action) {
                            if (isset(Yii::$app->user->identity->isAdmin)) {
                                return Yii::$app->user->identity->isAdmin;
                            }
                            return false;
                        },
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        Url::remember();

        $searchParams = Yii::$app->request->queryParams;

        $searchModel = new PartnerSearch;
        $searchModel->load($searchParams);
        $searchModel->pageNo = Yii::$app->request->get('pageNo');
        $searchResult = $searchModel->search();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $searchResult['dataProvider'],
            'pages' => $searchResult['pages'],
        ]);
    }
}
