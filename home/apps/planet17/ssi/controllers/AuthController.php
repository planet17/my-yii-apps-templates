<?php

namespace planet17\ssi\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use planet17\ssi\models\LoginForm;

class AuthController extends Controller
{
    public $defaultAction = 'in';

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

    public function actionIn()
    {
        echo('hello');
        die('<hr>');
        if (!\Yii::$app->user->isGuest) { return $this->goHome(); }
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) { return $this->goBack(); }
        return $this->render('login', [ 'model' => $model ]);
    }

    public function actionLogout() { Yii::$app->user->logout(); return $this->goHome(); }
}
