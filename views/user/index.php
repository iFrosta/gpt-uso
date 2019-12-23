<?php

/* @var $this yii\web\View */

/**
 * @var $model Position
 */

use app\models\Position;
use app\models\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>


    <?php
    $form = ActiveForm::begin();
    $items = [
        '0' => 'Активный',
        '1' => 'Отключен',
        '2'=>'Удален'
    ];
    $params = [
        'prompt' => 'Выберите статус...'
    ];
    echo $form->field($model, 'title')->dropDownList($items,$params);
    ActiveForm::end();
    ?>

    <code><?= __FILE__ ?></code>
</div>
