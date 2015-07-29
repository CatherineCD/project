<?php

namespace app\controllers;

use app\models\Networks;
use app\models\NetworksQuery;
use Yii;
use app\models\Users;
use app\models\News;
use app\models\UserNetworks;
use yii\web\Request;
use yii\db\Query;
use yii\web\HttpException;

class NewsController extends \yii\web\Controller
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
        $news = Yii::$app->user->getIdentity()->getNews($id)->all();
        $networks = Yii::$app->user->getIdentity()->networks;
        if (!$news)
        {
            throw new HttpException(404, 'No news');
        }
        return $this->render('index',[
            'dataProvider' => $news,
            'networks' => $networks,
	        'ids' => $ids,
        ]);
    }
}