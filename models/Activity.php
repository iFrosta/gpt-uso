<?php


namespace app\models;


use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * Класс - Событие
 *
 * @package app\models
 *
 * @property int $id [int(11)]  Порядковый номер
 * @property string $title [varchar(255)]  Название события
 * @property string $date_start [varchar(255)]  Дата начала
 * @property string $date_end [varchar(255)]  Дата окончания
 * @property int $user_id [int(11)]  Создатель события
 * @property string $description Описание события
 * @property bool $repeat [tinyint(1)]  Может ли повторяться
 * @property bool $blocked [tinyint(1)]  Блокирует ли даты
 *
 * @property-read User $user
 *
 * @property int $created_at [int(11)]
 * @property int $updated_at [int(11)]
 */
class Activity extends ActiveRecord
{
    public function behaviors()
    {
        return [TimestampBehavior::class,];
    }

    public static function tableName()
    {
        return 'activities';
    }

    /**
     * Правила валидации данных модели
     * @return array
     */
    public function rules()
    {
        return [
            [['title', 'date_start', 'description'], 'required'],

            [['title', 'description'], 'string'],
            [['title'], 'string', 'min' => 2, 'max' => 160],

            [['date_start', 'date_end'], 'date', 'format' => 'php:Y-m-d'],

            ['date_end', 'default', 'value' => function () {
                return $this->date_start;
            }],

            ['date_end', 'validateDate'],

            [['user_id'], 'integer'],

            [['repeat', 'blocked'], 'boolean'],
        ];
    }

    /**
     * Названия полей модели
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'id' => '#',
            'title' => 'Название',
            'date_start' => 'Дата начала',
            'date_end' => 'Дата окончания',
            'user_id' => 'Пользователь',
            'description' => 'Описание события',
            'repeat' => 'Повтор',
            'blocked' => 'Блокирующее',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата последнего изменения',
        ];
    }

    /**
     * Магический метод для получение зависимого объекта из БД
     * @return ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * Проверка даты окончания события (не раньше даты начала)
     *
     * @param $attr
     */
    public function validateDate($attr) // date_end
    {
        $start = strtotime($this->date_start);
        $end = strtotime($this->{$attr});

        if ($start && $end) {
            if ($end < $start) {
                $this->addError($attr, 'Некорректный формат даты');
            }
        }
    }
}