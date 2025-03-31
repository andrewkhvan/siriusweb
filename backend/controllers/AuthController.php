<?php

namespace backend\controllers;

use Yii;
use backend\models\LoginForm;
use backend\models\SignupForm;
use backend\models\PasswordResetRequestForm;
use backend\models\ResetPasswordForm;
use backend\models\VerifyEmailForm;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;

/**
 * Site controller
 */
class AuthController extends BaseController
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
                        'actions' => ['error', 'login', 'signup', 'reset-password', 'request-password-reset', 'verify-email'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['login-by-session'],
                        'allow' => true,
                        'roles' => ['?'],
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

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
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
                Yii::$app->session->setFlash('success', Yii::t('auth', 'You have successfully registered.').' '.Yii::t('auth', 'Check your email for further instructions.'));
                return $this->redirect(['auth/login']);
            } else {
                Yii::$app->session->setFlash('error', $request->errorMessage);

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


    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', Yii::t('auth', 'Check your email for further instructions.'));

                return $this->goHome();
            }

            Yii::$app->session->setFlash('error', Yii::t('auth', 'Sorry, we are unable to reset password for the provided email address.'));
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     */
    public function actionResetPassword($token = null)
    {
        $model = new ResetPasswordForm(['token' => $token]);

        if ($model->isTokenNotExpired()) {

            if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
                return $this->goHome();
            }

            return $this->render('resetPassword', [
                'model' => $model,
            ]);
        }

        return $this->redirect(['auth/request-password-reset']);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token = '')
    {
        $model = new VerifyEmailForm(['token' => $token]);

        if ($model->verifyEmail()) {
            Yii::$app->session->setFlash('success', Yii::t('auth', 'Your email has been confirmed!') .' '. Yii::t('auth', 'Now you can log in to your account.'));
        } else {
            Yii::$app->session->setFlash('error', Yii::t('auth', 'Sorry, we are unable to verify your account with provided token.'));
        }
        
        return $this->redirect(['auth/login']);
    }

    public function actionLoginBySession($sid)
    {
        Yii::$app->session->set('session_id', $sid);

        $user = \backend\models\User::findByApiRequest();

        if (!$user) {
            Yii::$app->session->setFlash('error', 'Can not login with this session_id');
            return $this->redirect(['auth/login']);
        }

        Yii::$app->user->login($user, 3600*24*30);
        return $this->goHome();
    }

}
