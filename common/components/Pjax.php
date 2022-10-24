<?php
namespace common\components;
use yii\helpers\VarDumper;
use yii\widgets\Pjax as PjaxBase;

class Pjax extends PjaxBase{
    public function init(){
        \yii\helpers\ArrayHelper::remove($_GET, '_pjax');
        $this->enablePushState = false;
        parent::init();
    }

    public static function wrapPjax($grid, $config=array()) {
        ob_start();
        $config['timeout'] = 10000;
        Pjax::begin($config);
        echo $grid;
        Pjax::end();

        return ob_get_clean();
    }
}