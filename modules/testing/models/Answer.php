<?php

namespace app\modules\testing\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "answers".
 *
 * @property integer $id
 * @property integer $id_question
 * @property string $text
 * @property string $type
 *
 * @property Question $idQuestion
 */
class Answer extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'answers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_question'], 'integer'],
            [['text', 'type'], 'string'],
            [['id_question'], 'exist', 'skipOnError' => true, 'targetClass' => Question::class, 'targetAttribute' => ['id_question' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_question' => 'Вопрос',
            'text' => 'Text',
            'type' => 'Type',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getIdQuestion()
    {
        return $this->hasOne(Question::class, ['id' => 'id_question']);
    }
}
