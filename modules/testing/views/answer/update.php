<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\testing\models\Answer */

$this->title = 'Редактирование ответа: ' . $model->text;
$this->params['breadcrumbs'][] = ['label' => 'Ответы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->text, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="answer-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
