<?php
/* @var $this yii\web\View */
/* @var $model File */

use app\models\Category;
use app\models\File;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin(['options' => []]) ?>
<?= $form->field($model, 'title')->textInput() ?>
<?= $form->field($model, 'path')->fileInput() ?>
<?php
// получаем все категории
$files = Category::find()->all();
// формируем массив, с ключем равным полю 'id' и значением равным полю 'title'
$items = ArrayHelper::map($files, 'id', 'title');
$params = [
    'prompt' => 'Укажите категорию'
];
echo $form->field($model, 'category_id')->dropDownList($items, $params);
?>
<?= $form->field($model, 'number')->textInput() ?>
<?= $form->field($model, 'date_in')->textInput(['type' => 'date']) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

<?php ActiveForm::end() ?>