<?php

namespace app\modules\testing\components;

use app\models\Result;
use app\modules\testing\models\TestForm;
use yii\base\Widget;

class DisplayTest extends Widget
{
    public $message;

    public function init()
    {
        parent::init();
        if ($this->id === null)
            $this->id = 0;
    }

    public function run()
    {
        $model = new TestForm();
        return $this->render('displaytest', [
            'model' => $model,
            'test' => TestForm::loadTest($this->id),
            'id' => $this->id,
            Result::ifRecord($this->id),
            'res' => Result::getUserTestStatus($this->id),
        ]);
    }
}