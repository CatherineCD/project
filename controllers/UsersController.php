<?php

namespace app\controllers;

use Yii;
use app\models\Users;
use app\models\News;
use app\models\UserNetworks;
//use yii\filters\AccessControl;

class UsersController extends \yii\web\Controller
{
	public function behaviors()
	{
		return [
			'access' => [
				'class' => \yii\filters\AccessControl::className(),
				'only' => ['registration', 'news', 'networknews'],
				'rules' => [
					[
						'allow' => true,
						'actions' => ['registration'],
						'roles' => ['?'],
					],
					[
							'allow' => true,
							'actions' => ['news', 'networknews'],
							'roles' => ['@'],
					],
				],
			],
		];
	}

    public function actionRegistration()
    {
	    $model = new Users();
	    if ($model->load(Yii::$app->request->post()) && $model->save())
	    {
		    return $this->redirect(['site/index']);
	    } else {
		    return $this->render('registration', [
			    'model' => $model,
		    ]);
	    }
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

	public function actionNetworknews($id)
	{
		$news = Yii::$app->user->getIdentity()->getNews($id)->all();
		return $this->render('networknews',[
			'dataProvider' => $news,
		]);
	}
}
