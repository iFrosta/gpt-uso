<?php


namespace app\controllers;


use app\modules\testing\models\Question;
use app\modules\testing\models\QuestionsTests;
use app\modules\testing\models\Test;
use app\modules\testing\models\TestForm;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

class TestController extends Controller
{
    /**
     * @return array
     * @inheritDoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
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
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $item = new TestForm();
        return $this->render('index', [
            'model' => $item
        ]);

//        return $this->render('index');
    }

    public function actionDisplayTest()
    {
        return $this->render('_displaytest', [
            'id_test' => Yii::$app->request->post('id_test'),
        ]);
    }
}