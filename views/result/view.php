<?php

/**
 * @var $this yii\web\View
 * @var $model Result
 */

use app\models\Result;
use yii\helpers\Html;
use yii\widgets\DetailView;

?>
    <div class="row">
        <h1>Просмотр результата</h1>

        <div class="form-group pull-right">
            <?= Html::a('К списку', ['result/index'], ['class' => 'btn btn-info']) ?>
        </div>
    </div>

<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        [
            // activity.id - пример перезаписи названия столбца
            'label' => 'Порядковый номер',
            'attribute' => 'id',
        ],
        [
            'label' => 'Название теста',
            'attribute' => 'test_id', // авто-подключение зависимостей
            'value' => function (Result $model) {
                return $model->test->name;
            }
            // $model->test->name
        ],
        [
            'label' => 'Описание теста',
            'attribute' => 'test_id', // авто-подключение зависимостей
            'value' => function (Result $model) {
                return $model->test->description;
            }
            // $model->test->name
        ],
        //'id',
        [
            'label' => 'Фамилия',
            'attribute' => 'user_id', // авто-подключение зависимостей
            'value' => function (Result $model) {
                return $model->user->last_name;
            }
            // $model->user->last_name
        ],
        [
            'label' => 'Имя',
            'attribute' => 'user_id', // авто-подключение зависимостей
            'value' => function (Result $model) {
                return $model->user->first_name;
            }
            // $model->user->last_name
        ],
        'date_test:datetime',
        'attempts',
        'quantity',
        'status:boolean',
    ],
]); ?>