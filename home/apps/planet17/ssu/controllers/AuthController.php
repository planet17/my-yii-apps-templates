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
                /*
                 * TODO; is now send works twice?
                 *
                    $.ajax({
                        url: "/demo/sign-up/",
                        dataType: "json",
                        method: "POST",
                        data: ({
                            "_csrf":"SjVNdVBhc18fXiQqPBg2DgxCFD8kJzYxGkx1NxsbOTwOGCQDAlAdNw==",
                            "Up": ({ "email":"demo@de.m" }),
                            "ajax":"signUP"
                        })
                    }).done(function(r) {
                        console.log(r['up-email'] if no undefined then length);
                    })
                 */
                $model->scenario = 'ajax';
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            } elseif($model->validate()) {
                /* if non-ajax */
                if (($user = $model->signUp()) instanceof User) {
                    if (Yii::$app->getUser()->login($user)) {
                        return $this->goHome();
                    }
                } else {
                    throw new HttpException(500, 'Something wrong at server! Error with registering new user!');
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
