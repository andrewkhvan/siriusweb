<?php

namespace console\controllers;

use yii\console\ExitCode;

class DevController extends \yii\console\Controller
{
    public function actionIndex()
    {
        echo "Testing dev/index\n";
        return ExitCode::OK;
    }

    public function actionCreateAdmin()
    {
        $admin = new \common\models\User();
        $admin->username = 'admin';
        $admin->email = 'admin@sirius-energy.co';
        $admin->status = 10;
        $admin->auth_key = '';
        $admin->setPassword('Zahid001');
        if ($admin->save()) {
            echo "User admin has been created\n";
        } else {
            echo "Error creating admin\n";
        }
        ExitCode::OK;
    }
}
