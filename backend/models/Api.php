<?php

namespace backend\models;

use Yii;
use GuzzleHttp\Exception\RequestException;

class Api extends \yii\base\Model
{
    public $token;
    public function request($action, $data = [])
    {
        $data['function'] = $action;
        $data['SessionId'] = Yii::$app->session->get('session_id');

        $guzzle = new \GuzzleHttp\Client(['base_uri' => Yii::$app->params['api_host']]);

        try {
            $response = $guzzle->post($uri='', [
                'headers' => [
                    'Authorization' => 'Basic ' . base64_encode(Yii::$app->params['access_token']),
                ],
                'json' => $data,
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
