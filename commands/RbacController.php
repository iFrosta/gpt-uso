<?php


namespace app\commands;


use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        $userRole = $auth->createRole('user');
        $userRole->description = 'Подчинённый';
        $auth->add($userRole);

        $auth->assign($userRole, 2);
    }

}