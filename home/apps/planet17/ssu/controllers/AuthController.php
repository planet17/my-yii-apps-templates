<?php

namespace planet17\ssu\controllers;

use planet17\ssu\models\Auth\Forms\Up;
use planet17\ssu\models\Auth\Models\User;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\HttpException;
use Yii;
use yii\web\Response;
use yii\widgets\ActiveForm;

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
        /* if user had been registered */
        if (!Yii::$app->user->isGuest) { return $this->complete(); }

        $model = new Up();
        /* if any data was sent to server */
        if ($model->load(Yii::$app->request->post())) {
            if (Yii::$app->request->isAjax) {

                /* if ajax-login-check */
                $model->scenario = 'ajax';
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);

            } elseif($model->validate()) {

                /* if non-ajax */
                if (($registrationResponse = $model->signUp()) instanceof User) {
                    if (Yii::$app->getUser()->login($registrationResponse)) { return $this->goHome(); }
                } else {
                    $msg = 'Something wrong at server! Error with registering new user!';

                    if (YII_ENV_DEV) { $msg .= json_encode($registrationResponse); }

                    throw new HttpException(500, $msg );
                }

            } else {
                throw new HttpException(500, 'Something wrong with sent data!');
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
