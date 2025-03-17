<?php

namespace backend\controllers;

use Yii;
use backend\models\LoginForm;
use backend\models\SignupForm;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;

/**
 * Site controller
 */
class AuthController extends Controller
{
    public $layout = 'blank';

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'signup'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Login action.
     *
     * @return string|Response
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionSignup($ref = null)
    {
        $model = new SignupForm(['sponsorEmail' => $ref]);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $request = $model->registerUser();
            if (!$request->HasError) {
                Yii::$app->session->setFlash('success', Yii::t('auth', 'You have successfully registered. Now you can log in to your account.'));
                return $this->redirect(['auth/login']);
            } else {
                $model->addError('email', $request->errorMessage);

                $model->password = '';
                $model->password_repeat = '';
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        $result = \backend\models\Api::request('logout');
        if ($result->HasError == false) {
            Yii::$app->user->logout();
        }

        return $this->goHome();
    }
}
