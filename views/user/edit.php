<?php

/**
 * @var $this yii\web\View
 * @var $model User
 */

use app\models\User;
use yii\helpers\Html;

?>
    <div class="row">
        <h1><?= Html::encode($model->id ? $model->last_name : 'Новый работник') ?></h1>

        <div class="form-group pull-right">
            <?= Html::a('Отмена', ['user/index'], ['class' => 'btn btn-info']) ?>
        </div>
    </div>

<?= $this->render('_form', [
    'model' => $model,
]) ?>