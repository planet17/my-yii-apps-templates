<?php

namespace planet17\ssu\controllers;

use planet17\ssu\models\Auth\Forms\Up;
use planet17\ssu\models\Auth\Models\User;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\HttpException;
use Yii;

class AuthController extends Controller
{
    public $defaultAction = 'up';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => ['logout' => ['post'], 'up' => ['get', 'post']],
            ],
        ];
    }

    public function actionUp()
    {
        if (!Yii::$app->user->isGuest) { return $this->complete(); }
        $model = new Up();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if (($user = $model->signUp()) instanceof User) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            } else {
                throw new HttpException(500, 'Something wrong at server! Error with registering new user!');
            }
        }

        return $this->render('up', [ 'model' => $model ]);
    }


    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }


    private function complete()
    {
        return $this->render('complete');
    }
}
