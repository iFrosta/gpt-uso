<?php

namespace app\modules\testing\models;

use Yii;
use yii\base\InvalidConfigException;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "questions".
 *
 * @property integer $id
 * @property string $title
 * @property string $type
 *
 * @property Answer[] $answers
 * @property QuestionsTests[] $questionsTests
 */
class Question extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'questions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type'], 'string'],
            [['title'], 'string', 'max' => 1000],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок вопроса',
            'type' => 'Количество ответов',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getAnswers()
    {
        return $this->hasMany(Answer::class, ['id_question' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getQuestionsTests()
    {
        return $this->hasMany(QuestionsTests::class, ['id_question' => 'id']);
    }

    /**
     * @return ActiveQuery
     * @throws InvalidConfigException
     */
    public function getTests(){
        return $this->hasMany(Test::class, ['id' => 'id_test'])
            ->viaTable('questions_tests', ['id_question' => 'id']);
    }
}
