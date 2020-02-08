<?php

use app\models\Position;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form ActiveForm */
?>


<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
    <?php  //Отображаем поля только при СОЗДАНИИ нового работника
    if (Yii::$app->request->pathInfo == 'user/create') {
        echo $form->field($model, 'password')->passwordInput();
        echo $form->field($model, 'special_cod')->textInput();
    };
    ?>
    <?= $form->field($model, 'first_name')->textInput() ?>
    <?= $form->field($model, 'last_name')->textInput() ?>
    <?= $form->field($model, 'third_name')->textInput() ?>
    <?= $form->field($model, 'telny_number')->textInput() ?>

    <?php
    // получаем все должности
    $users = Position::find()->all();
    // формируем массив, с ключем равным полю 'id' и значением равным полю 'title'
    $items = ArrayHelper::map($users, 'id', 'title');
    $params = [
        'prompt' => 'Укажите занимаемую должность'
    ];
    echo $form->field($model, 'position_id')->dropDownList($items, $params);
    ?>

    <?= $form->field($model, 'date_birth')->textInput(['type' => 'date']) ?>
    <?= $form->field($model, 'date_receipt')->textInput(['type' => 'date']) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
