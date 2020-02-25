<?php


namespace app\controllers;


use app\models\Activity;
use app\models\forms\SignupForm;
use app\models\forms\UpdateUserForm;
use app\models\Position;
use app\models\User;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;


class UserController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                // доступ только для админов
                'class' => AccessControl::class,
                'only' => ['index', 'view', 'create', 'update', 'delete'],
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
        $query = User::find();
        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
//                'validatePage' => false,
                'pageSize' => 10,
            ],
        ]);

        return $this->render('index', [
            'provider' => $provider,
        ]);
    }

    public function actionUser_homepage()
    {
        /** @var User $user */
        $user_id = Yii::$app->user->identity;

        $provider = new ActiveDataProvider([
            'query' => Activity::find()->where(['id' => $user_id]),
            'pagination' => [
                'validatePage' => false,
            ],
        ]);


        $model = new UpdateUserForm();

        if ($model->load(Yii::$app->request->post()) && $model->updatePass()) {
            Yii::$app->session->setFlash('success', 'Изменения успешно сохранены');
        } else if ($model->load(Yii::$app->request->post()) && !$model->updatePass()) {
            Yii::$app->session->setFlash('warning', 'Проверьте правильность заполнения');
        }

        return $this->render('user_homepage', compact('model', 'provider'));

    }

    /**
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView(int $id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post())) {
            $user = $model->register();
            if ($user) {
                return $this->redirect(['view', 'id' => $user->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate(int $id = null)
    {
        $item = $id ? User::findOne($id) : new User([
            'id' => Yii::$app->user->id,
        ]);

        // обновлять записи может только admin
        if (Yii::$app->user->can('admin')) {
            if ($item->load(Yii::$app->request->post()) && $item->validate()) {
                if ($item->save()) {
                    return $this->redirect(['user/view', 'id' => $item->id]);
                }
            }

            return $this->render('update', [
                'model' => $item,
            ]);
        } else {
            throw new NotFoundHttpException();
        }
    }

    public function actionDelete(int $id)
    {
       $item = $this->findModel($id);
       if ($item->id == Yii::$app->user->id) {
           return 'Удаление собственной записи невозможно';
       } else {
           $this->findModel($id)->delete();
       }

        return $this->redirect(['index']);
    }


    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
