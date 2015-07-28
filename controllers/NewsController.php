<?php

namespace app\controllers;

use app\models\Networks;
use app\models\NetworksQuery;
use Yii;
use app\models\Users;
use app\models\News;
use app\models\UserNetworks;
use yii\base\Request;
use yii\db\Query;
use yii\web\HttpException;

class NewsController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['news', 'networknews'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['news', 'networknews'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionNews()
    {
        $news = Yii::$app->user->getIdentity()->news;
        $networks = Yii::$app->user->getIdentity()->networks;

        return $this->render('news',[
            'dataProvider' => $news,
            'networks' => $networks
        ]);
    }

    public function actionNetworkNews($id)
    {
        if (!Networks::findOne($id))
        {
            throw new HttpException(404, 'No network with id='.$id);
        }
        $news = Yii::$app->user->getIdentity()->getNews($id)->all();
        if (!$news)
        {
            throw new HttpException(404, 'No news');
        }
        return $this->render('networknews',[
            'dataProvider' => $news,
        ]);
    }
}