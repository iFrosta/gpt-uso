<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\web\YiiAsset;

$this->title = Html::encode(Yii::$app->user->identity->username);
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

YiiAsset::register($this);

?>

<h1>Страница пользователя  <u><?= Html::encode(Yii::$app->user->identity->username)?></u></h1>


<h3><?= Html::encode(Yii::$app->user->identity->username) ?>,

<h3><?= Html::encode(Yii::$app->user->identity->first_name)?>,

    <?= Html::submitButton('можете изменить пароль', ['id' => 'changePass', 'class' => 'btn btn-primary btn-sm']) ?></h3>


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

<div>
    <h4>
        Посмотреть результаты теста можно по этой <?= Html::a('ссылке', ['result/index'], ['class' => 'btn btn-info'])?>
    </h4>
</div>

<?= $this->registerJsFile('../../web/js/changePassSlide.js') ?>

