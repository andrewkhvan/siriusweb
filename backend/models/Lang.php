<?php

namespace backend\models;

use yii\base\Model;

class Lang extends Model
{
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
}