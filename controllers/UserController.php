<?php

namespace app\controllers;

use Yii;
use app\models\User;
use yii\debug\panels\LogPanel;
use yii\helpers\Json;

class UserController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['login'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login'],
                        'roles' => ['?'],
                    ],
                ],
            ],
        ];
    }

    public function actionLogin($code)
    {
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL,'https://oauth.vk.com/access_token?client_id=5006568&client_secret=RTKev2vHrY4KvwkL63ZA&redirect_uri=http://project/user/login&code='.$code);
        curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);

        $jsonResponse = curl_exec($curl_handle);
        $response = Json::decode($jsonResponse);

        curl_close($curl_handle);

        if (!User::findByVkId($response['user_id']))
        {
            $model = new User();
            $model->vk_id = $response['user_id'];
            $model->save();
        }

        $model = User::findByVkId($response['user_id']);
        $model->token = $response['access_token'];
        $model->save();

        Yii::$app->user->login(User::findByVkId($response['user_id']), 3600*24*30);

        return $this->redirect(['site/index']);
    }

}
