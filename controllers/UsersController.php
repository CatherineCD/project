<?php

namespace app\controllers;

use Yii;
use app\models\Users;

class UsersController extends \yii\web\Controller
{
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

}
