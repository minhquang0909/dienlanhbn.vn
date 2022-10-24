<?php
namespace frontend\models;

use common\models\Partners as BPartners;
use Yii;
use yii\helpers\VarDumper;

class Partners extends BPartners{
    public static function getPartners($limit=12, $offset=0,$getTotal = true){
        $ckey = md5("Partners_getPartners"."_".$limit."_".$offset."_".$getTotal);
        $ctime = Yii::$app->params['cache_time'];
        $cache = Yii::$app->cache;
        $rs = $cache->get($ckey);
        if(!$rs) {
            $partners = self::find()->active()->offset($offset)->limit($limit)->all();
            if ($getTotal) {
                $result = [
                    'total' => self::find()->active()->count(),
                    'items' => $partners
                ];
            } else {
                $result = $partners;
            }
            $cache->set($ckey,$result,$ctime);
            $rs =  $result;
        }
        return $rs;
    }
}