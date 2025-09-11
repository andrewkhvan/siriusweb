<?php

namespace backend\controllers;

use Yii;

class BaseController extends \yii\web\Controller
{
    public function beforeAction($action)
    {
        $session = Yii::$app->session;
        if ($session->get('lang') == null) {
            $session->set('lang', 'en-US');
        }

        $lang = Yii::$app->request->get('lang');

        if ($lang) {
            $session->set('lang', $lang);
            \backend\models\Api::request('partner', ['language' => $lang]);
        }

        Yii::$app->language = $session->get('lang');

        if (!parent::beforeAction($action)) {
            return false;
        }

        if (!Yii::$app->user->isGuest) {
            $user = Yii::$app->user->identity;
            if (!$user->paid) {
                $route = $action->uniqueId;
                $allowed = ['cabinet/index', 'auth/logout'];
                if (!in_array($route, $allowed, true)) {
                    Yii::$app->response->redirect(['cabinet/index'])->send();
                    return false;
                }
            }
        }

        return true;
    }
}
