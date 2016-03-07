<?php

namespace planet17\ssu\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use planet17\ssu\models\Auth\Models\User;
/* use planet17\ssu\models\LoginForm; */

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
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actionUp()
    {

        return $this->render('up');
    }

    public function actionComplete()
    {
        if (Yii::$app->user->isGuest) { return $this->goHome(); }
    }

    /* public function actionIn()
    {
        if (!\Yii::$app->user->isGuest) { return $this->goHome(); }
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) { return $this->goBack(); }
        return $this->render('login', ['model' => $model,]);
    } */

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }
}
