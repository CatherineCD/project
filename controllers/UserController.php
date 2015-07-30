<?php

namespace app\controllers;

use app\models\Profile;
use Yii;
use app\models\User;
use yii\helpers\Json;
use app\helpers\QueryHelper;

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
        $query = QueryHelper::createQuery('access_token', ['code' => $code]);
        $response = QueryHelper::doQuery($query);

        $user = User::findOrCreateUser($response['user_id']);
        $user->token = $response['access_token'];
        $user->save();

        Yii::$app->user->login($user, 3600*24*30);

        return $this->redirect(['site/index']);
    }


}
