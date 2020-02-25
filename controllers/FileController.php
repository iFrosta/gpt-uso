<?php


namespace app\controllers;


use app\models\File;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\UploadedFile;

class FileController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                // доступ только для админов
                'class' => AccessControl::class,
                'only' => ['create', 'update', 'delete'],
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
        $model = new File();

        if (Yii::$app->request->isPost) {
            $model->path = UploadedFile::getInstance($model, 'path');
            if ($model->load(Yii::$app->request->post())) {
                Yii::$app->session->setFlash('success', 'Изображение загружено');
                $model->save();
                return $this->render('index', ['model' => $model]);
            }
        }
        return $this->render('index', ['model' => $model]);
    }
}