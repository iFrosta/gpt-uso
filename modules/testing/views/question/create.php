<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\testing\models\Question */

$this->title = 'Создать вопрос';
$this->params['breadcrumbs'][] = ['label' => 'Вопросы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="question-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
