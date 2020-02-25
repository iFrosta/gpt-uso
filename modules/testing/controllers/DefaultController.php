<?php

namespace app\modules\testing\controllers;

use app\models\Result;
use app\modules\testing\models\TestForm;
use Yii;
use yii\web\Controller;

/**
 * Default controller for the `testing` module
 */
class DefaultController extends Controller
{
    public $data;

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $model = new TestForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $data = TestForm::getCorrectAnswers($model->id_test);
            $countQuestions = count($data);
            $correctAnswers = 0;
            if (is_array($model->answers))
                foreach ($model->answers as $id => $answer) {
                    if (count(array_diff($answer, $data[$id])) == 0 && count(array_diff($data[$id], $answer)) == 0)
                        $correctAnswers++;
                }
            if ($correctAnswers >= ($countQuestions * 0.8)) {
                $this->data = round($correctAnswers / $countQuestions * 100);
                Result::testCompleted($model->id_test, $this->data);
            } else {
                $this->data = round($correctAnswers / $countQuestions * 100);
                Result::testNotCompleted($model->id_test, $this->data);
            }
        }
        return $this->redirect(['/test/display-test']);
    }
}
