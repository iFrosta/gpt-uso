<?php

namespace app\models;

use app\modules\testing\models\Test;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * Class Result
 * @package app\models
 *
 * @property int $id
 * @property int $test_id
 * @property int $user_id
 * @property int $date_test
 * @property int $attempts
 * @property int $quantity
 * @property bool $status
 * @property int $userID
 *
 * @property-read User $user
 * @property-read Test $test
 */
class Result extends ActiveRecord
{

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['date_test'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['date_test'],
                ],
            ],
        ];
    }


    /**
     * @return int
     */
    public static function getUserID(): int
    {
        return Yii::$app->user->id;
    }

    public static function tableName()
    {
        return 'results';
    }

    public function attributeLabels()
    {
        return [
            'id' => '№',
            'test_id' => 'Номер теста',
            'user_id' => 'Тестируемый',
            'date_test' => 'Дата прохождения',
            'attempts' => 'Количество попыток',
            'quantity' => 'Количество баллов',
            'status' => 'Результат',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function getTest()
    {
        return $this->hasOne(Test::class, ['id' => 'test_id']);
    }

    /* Проверка наличия записи в БД  */
    public static function ifRecord($testID)
    {
        $userID = self::getUserID();

        $sql = "SELECT * FROM results WHERE user_id = {$userID} AND test_id = {$testID}";
        $result = Yii::$app->db->createCommand($sql)->execute();
        if ($result == false) {
            $recordTest = new Result();
            $recordTest->test_id = $testID;
            $recordTest->user_id = $userID;
            $recordTest->attempts = 1;
            $recordTest->quantity = 0;
            $recordTest->status = 0;

            $recordTest->save();
        }
    }

    /* Получение данных из БД о тесте  */
    static public function getUserTestStatus($id)
    {
        $userID = self::getUserID();

        $sql = "SELECT * FROM results WHERE test_id = {$id} AND user_id = {$userID}";
        $result = Yii::$app->db->createCommand($sql)->query();
        if ($result) {
            $data = [];
            foreach ($result as $key => $res) {
                $data['test_id'] = $res['test_id'];
                $data['user_id'] = $res['user_id'];
                $data['quantity'] = $res['quantity'];
                $data['status'] = $res['status'];
                $data['attempts'] = $res['attempts'];
            }
            return $data;
        } else {
            return false;
        }
    }

    /* Если тест не сдан  */
    public static function testNotCompleted($id, $data)
    {
        $userID = self::getUserID();

        $recordTest = Result::findOne(['test_id' => $id, 'user_id' => $userID]);
        $recordTest->attempts++;
        $recordTest->quantity = $data;

        $recordTest->save();

    }

    /* Если тест сдан  */
    public static function testCompleted($id, $data)
    {
        $userID = self::getUserID();

        $recordTest = Result::findOne(['test_id' => $id, 'user_id' => $userID]);
        $recordTest->attempts++;
        $recordTest->quantity = $data;
        $recordTest->status = 1;

        $recordTest->save();
    }
}