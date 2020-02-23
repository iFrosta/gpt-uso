<?php

/* @var $this yii\web\View */

$this->title = 'Тест';

use yii\base\InvalidConfigException; ?>

            <?= $this->render('_displaytest', [
                'model' => $model,
            ]) ?>

<?php try {
    Yii::$app->view->registerJsFile('../../web/js/getTime.js');
} catch (InvalidConfigException $e) {
} ?>