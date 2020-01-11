<?php
/**
 * @var $this yii\web\View
 * @var $model app\models\Activity
 */
use yii\helpers\Html;
?>
    <div class="row">
        <h1>Новое событие</h1>

        <div class="form-group pull-right">
            <?= Html::a('Назад', ['activity/index'], ['class' => 'btn btn-info']) ?>
        </div>
    </div>

<?= $this->render('_form', [
    'model' => $model,
]) ?>