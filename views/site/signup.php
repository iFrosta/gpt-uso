<?php

/**
 * @var $this yii\web\View
 * @var $form yii\bootstrap\ActiveForm
 * @var $model app\models\forms\LoginForm
 *
/* * <?= $form->field($model, 'position')->textInput() ?> */


use app\models\Position;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="site-login">
    <div class="text-center" style="padding: 20px 0 70px 0;">
        <h1><?= Html::encode($this->title) ?></h1>

        <p>Заполните форму для регистрации</p>
    </div>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

    <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput() ?>

    <?= $form->field($model, 'special_cod')->textInput() ?>
    <?= $form->field($model, 'first_name')->textInput() ?>
    <?= $form->field($model, 'last_name')->textInput() ?>
    <?= $form->field($model, 'third_name')->textInput() ?>
    <?= $form->field($model, 'telny_number')->textInput() ?>

    <?php
    // получаем все должности
        $users = Position::find()->all();
    // формируем массив, с ключем равным полю 'id' и значением равным полю 'title'
        $items = ArrayHelper::map($users,'id','title');
        $params = [
            'prompt' => 'Укажите занимаемую должность'
        ];
        echo $form->field($model, 'position_id')->dropDownList($items,$params);
    ?>

    <?= $form->field($model, 'date_birth')->textInput(['type' => 'date']) ?>
    <?= $form->field($model, 'date_receipt')->textInput(['type' => 'date']) ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Продолжить', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>
