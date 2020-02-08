<?php

/* @var $this View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\web\View;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Главная', 'url' => ['/site/index']],

            ['label' => 'Пройти тест', 'url' => ['/test/index'], 'visible'=>Yii::$app->user->can('user')],

            ['label' => 'Работники', 'url' => ['/user/index'], 'visible'=>Yii::$app->user->can('admin')],
            ['label' => 'События', 'url' => ['/activity/index']],
            [
                'label' => 'Работа с тестами',
                'items' => [
                    ['label' => 'Список тестов', 'url' => ['/testing/test']],
                    ['label' => 'Список вопросов', 'url' => ['/testing/question']],
                    ['label' => 'Список ответов', 'url' => ['/testing/answer']],
                ], 'visible'=>Yii::$app->user->can('admin')
            ],
            [
                'label' => 'Личный кабинет',
                'url' => ['/user/user_homepage?id=' . Yii::$app->user->id],
                'visible'=>Yii::$app->user->can('user')
            ],

//            Yii::$app->user->isGuest ? (
//                ['label' => 'Личный кабинет', 'url' => ['/site/login']]
//            ) : (
//                '<li>'
//                . Html::beginForm(['/user/user_homepage?id=' . Yii::$app->user->id], 'post')
//                . Html::submitButton(
//                    'Страница (' . Yii::$app->user->identity->username . ')',
//                    ['class' => 'btn btn-link logout']
//                )
//                . Html::endForm()
//                . '</li>'
//            ),

            Yii::$app->user->isGuest ? (
                ['label' => 'Войти', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Выйти (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; АФ ООО "Газпромтранс" <?= date('Y') ?></p>

<!--        <p class="pull-right">--><?//= Yii::powered() ?><!--</p>-->
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
