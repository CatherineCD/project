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
				'only' => ['registration', 'news'],
				'rules' => [
					[
						'allow' => true,
						'actions' => ['registration'],
						'roles' => ['?'],
					],
					[
							'allow' => true,
							'actions' => ['news'],
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
		$news = Users::findOne(Yii::$app->user->id)->news;

		return $this->render('news',[
			'dataProvider' => $news
		]);
	}
}
