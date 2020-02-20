<?php

/* @var $this yii\web\View */

$this->title = 'Тест';
?>

<div id="time">Time: </div>

<div class="site-index">
        <?= $this->render('_displaytest', [
            'model' => $model,
        ]) ?>
</div>

<script>
    setInterval(function(){
        $.ajax({url: "../tim.php", success: function(response){
                $('#time').html(response)
            }});
    }, 1000);
</script>
