<?php
namespace frontend\models;

use common\models\ServiceCategory as BaseModel;
use Yii;
use yii\helpers\VarDumper;

class ServiceCategory extends BaseModel{
    public static function getRootCategory(){
        $ckey = md5("FServiceCategory_getRootCategory");
        $ctime = Yii::$app->params['cache_time'];
        $cache = Yii::$app->cache;
        $rs = $cache->get($ckey);
        if(!$rs){
            $rs = self::find()->where(['parent_id'=>self::ROOT_CATEGORY])->active()->all();
            $cache->set($ckey,$rs,$ctime);
        }
        return $rs;
    }

    public static function getAllCategories($type = self::TYPE_CATEGORY_LIST, $reject_id = 0){
        $ckey = md5("FServiceCategory_getAllCategories_".$type."_".$reject_id);
        $ctime = Yii::$app->params['cache_time'];
        $cache = Yii::$app->cache;
        $rs = $cache->get($ckey);
        if(!$rs) {
            $rs = parent::getAllCategory($type, $reject_id = 0);
            $cache->set($ckey, $rs, $ctime);
        }
        return $rs;
    }

    public static function getCategoryChildsById($category_id){
        $ckey = md5("FServiceCategory_getCategoryChildsById_".$category_id);
        $ctime = Yii::$app->params['cache_time'];
        $cache = Yii::$app->cache;
        $rs = $cache->get($ckey);
        if(!$rs){
            $rs = self::find()->where(['parent_id'=>$category_id])->active()->all();
            $cache->set($ckey, $rs, $ctime);
        }
        return $rs;
    }

}