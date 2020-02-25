<?php


namespace app\models;


use yii\db\ActiveRecord;

/**
 * Class Category
 * @package app\models
 *
 * @property int $id
 * @property string $title
 */
class Category extends ActiveRecord
{
    public static function tableName()
    {
        return 'categories';
    }

    public function attributeLabels()
    {
        return [
            'id' => '№',
            'title' => 'Категория',
        ];
    }
}