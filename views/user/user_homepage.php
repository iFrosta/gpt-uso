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

<h3><?= Html::encode(Yii::$app->user->identity->username) ?>, можете изменить пароль</h3>


<div class="container">


    <div class="col-lg-3">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'password')->passwordInput(['autofocus' => true]) ?>
        <?= $form->field($model, 'reenter_password')->passwordInput() ?>

        <div class="form-group">
            <?= Html::submitButton('Применить', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>