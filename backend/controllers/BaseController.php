<?php

namespace backend\controllers;

use Yii;

class BaseController extends \yii\web\Controller
{
    public function beforeAction($action)
    {
        $session = Yii::$app->session;
        if ($session->get('lang') == null) {
            $session->set('lang', 'ru-RU');
        }

        $lang = Yii::$app->request->get('lang');

        if ($lang) {
            $session->set('lang', $lang);
        }

        Yii::$app->language = $session->get('lang');

        return parent::beforeAction($action);
    }
}
