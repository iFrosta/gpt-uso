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

<h3><?= Html::encode(Yii::$app->user->identity->username) ?>
    , <?= Html::submitButton('можете изменить пароль', ['id' => 'changePass', 'class' => 'btn btn-success']) ?></h3>


<div class="container">
    <div id="changePassSlider" class="col-lg-3" style="display: none">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'password')->passwordInput(['autofocus' => true]) ?>
        <?= $form->field($model, 'reenter_password')->passwordInput() ?>

        <div class="form-group">
            <?= Html::submitButton('Применить', ['id' => 'changedPass', 'class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>

<?= $this->registerJsFile('../../web/js/changePassSlide.js') ?>

