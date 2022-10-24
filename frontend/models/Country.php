<?php
namespace frontend\models;

use common\models\Country as BaseModel;
use Yii;

class Country extends BaseModel{
    public static function getAllCountry(){
        $ckey = md5("FCountry_getAllCountry");
        $ctime = Yii::$app->params['cache_time'];
        $cache = Yii::$app->cache;
        $rs = $cache->get($ckey);
        if(!$rs){
            $rs = self::find()->all();
            $cache->set($ckey,$rs,$ctime);
        }
        return $rs;
    }
}