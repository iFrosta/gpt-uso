<?php

use app\modules\testing\components\DisplayTest;
use app\modules\testing\models\TestForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var TestForm $res */
$attempts = $res['attempts'];
$noAttempts = Html::tag('p', "Пройдите тест!");
$quantity = $res['quantity'] ? $res['quantity'] : 0;
$status = $res['status'];
$testInfo = Html::tag('p', " В прошлый раз Вы набрали баллов: ");
$noTest2 = Html::tag('p', "Тест не пройден.");

/** @var DisplayTest $test */
if ($test) {
    $id_form = 'form_answers_' . uniqid();
    ?>
    <div class="container main-body">

        <div class="testInfoBlock col-lg-3">
            <div class="timeWindow">
                <span id="time1"></span>
                <span id="time"></span>
            </div>
            <br>

            <div>
                <?php
                if ($attempts == 1 || null) {
                    echo Html::tag('span', $noAttempts, ['id' => 'testNotComplete']);
                } elseif ($status == 0 || null) {
                    echo Html::tag('span', $testInfo, ['id' => 'testNotComplete']);
                    echo Html::tag('span', $quantity, ['id' => 'quantityPoints']);
                    echo Html::tag('span', $noTest2, ['id' => 'testNotComplete']);
                    echo Html::tag('span', "Попытка №&nbsp;",
                            ['style' => 'color: #00cc00; font-size: 1.4em']) . '' .
                        Html::tag('span', $attempts, ['id' => 'numberTestNotComplete']);
                } else {
                    echo Html::tag('p', 'Тест пройден.', ['id' => 'testNotComplete',
                        'style' => 'color: #00cc00; font-size: 2.4em']);
                }
                ?>
            </div>
        </div>

        <div class="site-index col-lg-9">
            <div class="text-left">
                <h1><?= $test['name'] ?></h1>
            </div>

            <?php
            $form = ActiveForm::begin([
                'id' => $id_form, 'action' => ['/testing'], //testing/default/index'enableAjaxValidation' => false,
                'enableClientValidation' => true
            ]);
            /** @var TestForm $id */
            echo $form->field($model, 'id_test')->hiddenInput(['value' => $id])->label(false);
            foreach ($test['questions'] as $id_question => $question) {
                ?>
                <div class="panel panel-default">
                    <div class="panel-heading"
                         style="background-color: #72b6e5; font-style: italic;">
                        <?= $question['title'] ?></div>
                    <div class="panel-body">
                        <?php

                        $markerType = ($question['type'] == 'one') ? 'radio' : 'checkbox';

                        echo $form->field($model, 'answers[' . $id_question . '][]')->radioList(ArrayHelper::getColumn($question['answers'], 'text'),
                            [
                                'unselect' => null,
                                'item' => function ($index, $label, $name, $checked, $value) use ($markerType) {
                                    return '<div class=$markerType><label style="font-weight: bold" ' . ($checked ? ' active' : '') . '">' .
                                        Html::$markerType($name, $checked, ['value' => $value]) . ' ' . $label . '</label></div>';
                                }
                            ]
                        )->label(false);
                        ?>
                    </div>
                </div>
                <?php
            }
            ?>
            <?php
            if ($status == 0) {
                echo Html::tag('div', Html::submitButton(
                    'Проверить', ['class' => 'btn btn-success']), ['class' => 'form-group']);
            }
            ?>

        </div>

    </div>

    <?php
    ActiveForm::end();
}
?>

