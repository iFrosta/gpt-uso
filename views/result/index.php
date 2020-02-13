<?php

/**
 * @var $this yii\web\View
 * @var $provider ActiveDataProvider
 */

use app\models\Result;
use yii\data\ActiveDataProvider;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;

$columns = [

    [
        // activity.id - пример перезаписи значения
        'label' => 'Порядковый номер',
        'value' => function (Result $model) {
            return "# {$model->id}";
        },
    ],
    [
        'label' => 'Название теста',
        'attribute' => 'test_id', // авто-подключение зависимостей
        'value' => function (Result $model) {
            return $model->test->name;
        }
        // $model->test->name
    ],
    //'user_id',
    [
        'label' => 'Кто проходил',
        'attribute' => 'user_id', // авто-подключение зависимостей
        'value' => function (Result $model) {
            return $model->user->last_name;
        }
        // $model->user->last_name
    ],
    'date_test:datetime',
    'attempts',
    'quantity',
    'status:boolean',
//    [
//
//        'attribute' => 'status',
//
//        'format' => 'raw',
//
//        'value' => function ($model, $index, $widget) {
//
//            return Html::checkbox('status', $model->status, ['value' => $index, 'disabled' => true]);
//
//        },
//
//    ],

];

if (Yii::$app->user->can('admin')) {
    $columns[] = [
        'class' => ActionColumn::class,
        'header' => 'Операции',
    ];
} else if (Yii::$app->user->can('user')) {
    $columns[] = [
        'class' => ActionColumn::class,
        'header' => 'Операции',
        'template' => '{view}'
    ];
}

?>

    <div class="row">
        <h1>Список результатов</h1>
    </div>

<?= GridView::widget([
    'dataProvider' => $provider, // $provider->getModels() [....]
    'columns' => $columns,
]) ?>