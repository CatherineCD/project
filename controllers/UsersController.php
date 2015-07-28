<?php

namespace app\controllers;

use app\models\Networks;
use Yii;
use app\models\Users;
use app\models\News;
use app\models\UserNetworks;
use yii\base\Request;
use yii\db\Query;

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

    public function actionNetworks()
    {
        $id = Yii::$app->user->id;
        $userNetworks = Users::findOne($id)->networks;
        $networks = (new Query())
            ->select('networks.*, user_networks.user_id')
            ->from('networks')
            ->leftJoin('user_networks', 'networks.id = user_networks.network_id AND user_networks.user_id = :id', [':id' => $id])
            ->all();
        return $this->render('networks', [
            'id' => $id,
            'userNetwors' => $userNetworks,
            'networks' => $networks,
        ]);
    }

    public function actionAdd($networkId, $token = null)
    {
        Yii::$app->db->createCommand()->insert('user_networks',
            [
                'user_id' => Yii::$app->user->id,
                'network_id' => $networkId,
                'token' => $token,
            ])->execute();
        return $this->redirect('networks');
    }

    public function actionRemove($networkId)
    {
        Yii::$app->db->createCommand()->delete('user_networks',
            [
                'user_id' => Yii::$app->user->id,
                'network_id' => $networkId,
            ])->execute();
        return $this->redirect('networks');
    }
}
