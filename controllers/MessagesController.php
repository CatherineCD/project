<?php

namespace app\controllers;

use app\models\Networks;
use app\models\Messages;
use app\models\MessagesQuery;
use app\models\NetworksQuery;
use Yii;
use app\models\Users;
use app\models\News;
use app\models\UserNetworks;
use yii\web\Request;
use yii\db\Query;
use yii\web\HttpException;

class MessagesController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex(array $id = NULL)
    {
        $ids = Yii::$app->request->get('id');
        $messages = Yii::$app->user->getIdentity()->getMessages($id)->all();
        $networks = Yii::$app->user->getIdentity()->networks;
        if (!$messages)
        {
            throw new HttpException(404, 'No messages');
        }
        return $this->render('index',[
            'dataProvider' => $messages,
            'networks' => $networks,
            'ids' => $ids,
        ]);
    }
}