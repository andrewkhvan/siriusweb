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

    /**
     * Request without session_id
     */
    public static function requestAuth($action, $data = [])
    {
        $data['function'] = $action;

        $guzzle = new \GuzzleHttp\Client(['base_uri' => Yii::$app->params['api_host']]);

        try {
            $response = $guzzle->post($uri='', [
                'headers' => [
                    'Authorization' => 'Basic ' . base64_encode(Yii::$app->params['access_token']),
                ],
                'json' => $data,
            ]);
        } catch (RequestException $e) {
            return (object) ['HasError' => true, 'Message' => 'Request fail', 'errorMessage' => 'Request fail'];
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
                    'IP' => static::userIP(),
                    'UserAgent' => Yii::$app->request->userAgent,
                ],
            ]);
        } catch (RequestException $e) {
            return (object) ['HasError' => true, 'Message' => 'Request fail', 'errorMessage' => 'Request fail'];
        }

        $output = $response->getBody()->getContents();
        if ($output !== null) {
            $output = json_decode($output);
        }

        return $output;
    }

    public static function userIP()
    {
        $ip = Yii::$app->request->userIP;
        if (isset($_SERVER['HTTP_X_REAL_IP'])) {
            $ip .= " [{$_SERVER['HTTP_X_REAL_IP']}]";
        }

        return $ip;
    }

    public static function register($data)
    {
        $guzzle = new \GuzzleHttp\Client(['base_uri' => Yii::$app->params['api_host']]);

        $data['function'] = 'registration';
        $data['IP'] = Yii::$app->request->userIP;
        $data['UserAgent'] = Yii::$app->request->userAgent;

        try {
            $response = $guzzle->post($uri='', [
                'headers' => [
                    'Authorization' => 'Basic ' . base64_encode(Yii::$app->params['access_token']),
                ],
                'json' => $data,
            ]);
        } catch (RequestException $e) {
            return (object) ['HasError' => true, 'Message' => 'Request fail', 'errorMessage' => 'Request fail'];
        }

        $output = $response->getBody()->getContents();
        if ($output !== null) {
            $output = json_decode($output);
        }

        return $output;
    }
}
