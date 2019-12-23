<?php


namespace app\commands;

use app\models\User;
use yii\console\Controller;
use yii\i18n\Formatter;

class AppController extends Controller
{
    public function actionUsers()
    {
        $admin = new User([
            'username' => 'goryunovAN',
            'access_token' => 'test',
            'created_at' => time(),
            'updated_at' => time(),
            'first_name' => 'Алексей',
            'last_name' => 'Горюнов',
            'third_name' => 'Николаевич',
            'telny_number' => 270270,
            'position' => 'Приёмосдатчик груза и багажа',
            'date_birth' => date('Y-m-d', strtotime('23.02.1980')),
            'date_receipt' => date('Y-m-d', strtotime('15.03.2013')),

        ]);

        $admin->generateAuthKey();
        $admin->password = 'qwerty123';
        /**
         * реализовать проверку на уже существующую запись в БД
         */
//        $findByUsername = User::findOne($admin->username);
//        if (!isset($findByUsername)) {
//            $admin->save();
//        }
        $admin->save();


    }
}