<?php


namespace app\models;


use app\modules\testing\models\Test;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * Class Result
 * @package app\models
 *
 * @property int $id
 * @property int $test_id
 * @property int $user_id
 * @property string $date_test
 * @property int $attempts
 * @property int $quantity
 * @property bool $status
 */
class Result extends ActiveRecord
{
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'date_test',
            ],
        ];
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
        return $this->hasMany(User::class, ['id' => 'user_id']);
    }

    public function getTest()
    {
        return $this->hasMany(Test::class, ['id' => 'test_id']);
    }
}