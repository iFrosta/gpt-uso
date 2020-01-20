<?php

namespace app\modules\testing\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "tests".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 *
 * @property QuestionsTests[] $questionsTests
 */
class Test extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tests';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['name'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'description' => 'Описание',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getQuestionsTests()
    {
        return $this->hasMany(QuestionsTests::class, ['id_test' => 'id']);
    }
}
