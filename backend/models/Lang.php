<?php

namespace backend\models;

use Yii;
use yii\base\Model;

class Lang extends Model
{
    const FLAGS = [
        'en-US' => '/images/flags/us.svg',
        'es-ES' => '/images/flags/spain.svg',
        'de-DE' => '/images/flags/germany.svg',
        'it-IT' => '/images/flags/italy.svg',
        'ru-RU' => '/images/flags/russia.svg',
        'zh-CN' => '/images/flags/china.svg',
        'fr-FR' => '/images/flags/french.svg',
        'ar' => '/images/flags/ae.svg',
    ];

    public static function getList()
    {
        return [
            'en-US' => 'English',
            'es-ES' => 'Española',
            'de-DE' => 'Deutsche',
            'it-IT' => 'Italiana',
            'ru-RU' => 'Русский',
            'zh-CN' => '中国人',
            'fr-FR' => 'Français',
            'ar' => 'Arabic',
        ];
    }

    public static function getFlag($lang = null)
    {
        if (empty($lang)) {
            $lang =Yii::$app->session->get('lang');
        }

        return static::FLAGS[$lang];
    }
}
