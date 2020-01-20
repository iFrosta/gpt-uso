<?php

use app\modules\testing\components\DisplayTest;
use app\modules\testing\models\Test;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\Pjax;

?>
<?php Pjax::begin(); ?>
<?= Html::beginForm(['test/display-test'], 'post', ['data-pjax' => '', 'class' => 'form-inline']); ?>
<?= Html::dropdownList('id_test',null,
    ArrayHelper::map(Test::find()->select(['id','name'])->all(),'id','name')
); ?>
    <div class="form-group">
<?= Html::submitButton('Пройти тест', ['class' => 'btn btn-primary btn-bg', 'name' => 'hash-button']) ?>
    </div>
<?= Html::endForm() ?>
<?= DisplayTest::widget(['id'=>$id_test ? $id_test : 1,'message' => 'Good morning']) ?>
<?php Pjax::end(); ?>