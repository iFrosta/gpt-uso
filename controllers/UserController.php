<?php


namespace app\controllers;


use app\models\forms\SignupForm;
use app\models\Position;
use app\models\User;
use yii\filters\AccessControl;
use yii\web\Controller;

class UserController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                // доступ только для админов
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $model = new Position();
        return $this->render('index', [
            'model' => $model,
        ]);
    }
}