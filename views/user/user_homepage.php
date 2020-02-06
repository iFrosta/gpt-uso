<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\web\YiiAsset;

$this->title = Html::encode(Yii::$app->user->identity->username);
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

YiiAsset::register($this);

?>

<h1>Страница пользователя &nbsp; <?= Html::encode(Yii::$app->user->identity->username) ?></h1>

<h3>Имя пользователя: &nbsp; <?= Html::encode(Yii::$app->user->identity->username) ?></h3>



<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

<!--    --><?//= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput() ?>
    <?= $form->field($model, 'reenter_password')->passwordInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Применить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>