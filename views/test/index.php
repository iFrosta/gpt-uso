<?php

/* @var $this yii\web\View */

$this->title = 'Тест';
?>
<div class="site-index">
        <?= $this->render('_displaytest', [
            'model' => $model,
        ]) ?>
</div>
