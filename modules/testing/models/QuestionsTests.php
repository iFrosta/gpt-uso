<?php

namespace app\modules\testing\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "questions_tests".
 *
 * @property integer $id
 * @property integer $id_test
 * @property integer $id_question
 *
 * @property Question $idQuestion
 * @property Test $idTest
 */
class QuestionsTests extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'questions_tests';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_test', 'id_question'], 'integer'],
            [['id_question'], 'exist', 'skipOnError' => true, 'targetClass' => Question::class, 'targetAttribute' => ['id_question' => 'id']],
            [['id_test'], 'exist', 'skipOnError' => true, 'targetClass' => Test::class, 'targetAttribute' => ['id_test' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_test' => 'Id Test',
            'id_question' => 'Id Question',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getIdQuestion()
    {
        return $this->hasOne(Question::class, ['id' => 'id_question']);
    }

    /**
     * @return ActiveQuery
     */
    public function getIdTest()
    {
        return $this->hasOne(Test::class, ['id' => 'id_test']);
    }
}
