<?php

namespace backend\models;

use Yii;
use GuzzleHttp\Exception\RequestException;

class Api extends \yii\base\Model
{
    public static function request($action, $data = [])
    {
        $sess_id = Yii::$app->session->get('session_id');

        if (!$sess_id) {
            Yii::$app->user->logout();
            return null;
        }

        $data['SessionId'] = $sess_id;
        $data['function'] = $action;
        // $data['SessionId'] = '595d946c-25ad-4436-9dbd-ef8cf3a47573';

        $guzzle = new \GuzzleHttp\Client(['base_uri' => Yii::$app->params['api_host']]);

        try {
            $response = $guzzle->post($uri='', [
                'headers' => [
                    'Authorization' => 'Basic ' . base64_encode(Yii::$app->params['access_token']),
                ],
                'json' => $data,
            ]);
        } catch (RequestException $e) {
            return (object) ['HasError' => true, 'errorMessage' => 'Request fail'];
        }

        $output = $response->getBody()->getContents();

        if ($output !== null) {
            $output = json_decode($output);
        }

        return $output;
    }

    public static function auth($username, $password)
    {
        $guzzle = new \GuzzleHttp\Client(['base_uri' => Yii::$app->params['api_host']]);

        try {
            $response = $guzzle->post($uri='', [
                'headers' => [
                    'Authorization' => 'Basic ' . base64_encode(Yii::$app->params['access_token']),
                ],
                'json' => [
                    'function' => 'login',
                    'Email' => $username,
                    'Password' => $password,
                    'IP' => Yii::$app->request->userIP,
                    'UserAgent' => Yii::$app->request->userAgent,
                ],
            ]);
        } catch (RequestException $e) {
            return [];
        }

        $output = $response->getBody()->getContents();
        if ($output !== null) {
            $output = json_decode($output);
        }

        return $output;
        
    }
}
