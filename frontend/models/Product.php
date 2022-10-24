<?php
namespace frontend\models;
use common\components\CFunction;
use common\models\Product as BaseModel;
use Yii;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\helpers\VarDumper;

class Product extends BaseModel{
    public static function getArrayList($limit=10)
    {
        $result = [
            '0'  =>  [
                'id' => '',
                'title' => Yii::t('frontend','Select product')
            ]
        ];
        $lang = Yii::$app->language;
        $ckey = md5('FProduct_getArrayList_'.$lang."_".$limit);
        $ctime = Yii::$app->params['cache_time'];
        $cache = Yii::$app->cache;
        $result2 = [];
        $rs = $cache->get($ckey);
        if(!$rs){
            $rs = Product::find()->where([
                'status'    =>  Product::STATUS_PUBLISHED
            ])->select('id, title,title_en')->limit($limit)->all();
            $cache->set($ckey, $rs, $ctime);
        }
        if (is_array($rs) && count($rs) > 0) {
            foreach ($rs as $item) {
                $tmp = [];
                $tmp['id'] = $item->id;
                if($lang=='en') {
                    $tmp['title'] = $item->title_en??'';
                }else{
                    $tmp['title'] = $item->title??'';
                }
                $result2[$item->id] = $tmp;
            }
        }
        $return = array_merge($result, $result2);
        return $return;
    }


    public function getCategoryTree($parent_id = 0){
        $lang = Yii::$app->language;
        $ckey = md5('FProduct_getCategoryTree_'.$lang."_".$parent_id);
        $ctime = Yii::$app->params['cache_time'];
        $cache = Yii::$app->cache;
        $rs = $cache->get($ckey);
        if(!$rs){
            $rs = $this->_getChildCategory($parent_id);
            $cache->set($ckey, $rs, $ctime);
        }
        return $rs;
    }

    public function getCategoryTreeReverse($category){
        $cat = array($category);
        return array_merge($cat, $this->_getCategoryParent($category));
    }

    protected function _getCategoryParent($parent){
        $cat = array();
        $parent = $this->getProductCategoryById($parent['parent_id'], true);
        $parent = array(
            'id' => $parent['id'],
            'parent_id' => $parent['parent_id'],
            'slug' => $parent['slug'],
            'sort_order' => $parent['sort_order'],
            'title' => CFunction::getAttributeByLanguage($parent,'title')
        );
        if($parent){
            $cat[] = $parent;
            if($parent['parent_id'] > 0){
                $parents = $this->_getCategoryParent($parent);
                $cat = array_merge($cat, $parents);
            }
        }
        return $cat;
    }

    protected function getProductCategoryById($id){
        return ProductCategory::find($id)->one();
    }

    protected function _getChildCategory($parent_id = 0){
        $cat = array($parent_id);
        $childs = Yii::$app->db->createCommand(" SELECT * FROM {{%product_category}}
          WHERE `status` = '".(int)ProductCategory::STATUS_ACTIVE."' AND `parent_id`='" . (int)$parent_id . "'"
        )->queryAll();
        if ($childs) {
            foreach ($childs as $item) {
                $cat[] = $item['id'];
                $child = $this->_getChildCategory($item['id']);
                if (is_array($child) && count($child) > 0) {
                    $cat = array_merge($cat, $child);
                }
            }
        }
        return $cat;
    }

    public static function getSimilarProducts($id,$category_id, $limit=3){
        $lang = Yii::$app->language;
        $ckey = md5('FProduct_getSimilarProducts_'.$lang."_".$id."_".$category_id."_".$limit);
        $ctime = Yii::$app->params['cache_time'];
        $cache = Yii::$app->cache;
        $rs = $cache->get($ckey);
        if(!$rs) {
            $sql = "SELECT p.*, c.`name` AS 'country' 
              FROM {{%product}} p LEFT JOIN {{%country}} c ON p.`country` = c.`id` 
              WHERE p.`id` <> ".(int)$id." AND p.`status` = " . self::STATUS_PUBLISHED . " AND `category_id` = ".(int)$category_id." 
              ORDER BY p.`id` DESC LIMIT " . (int)$limit . " ";
            $rs = Yii::$app->db->createCommand($sql)->queryAll();
            $cache->set($ckey, $rs, $ctime);
        }
        return $rs;
    }

    public static function buildCategoryUrl($cat, $type){
        switch ($type){
            case 'product':
                $url_cat = Url::to(['product/index', 'category_slug' => $cat['slug']]);
                break;
            case 'service':
                $url_cat = Url::to(['service/index', 'category_slug' => $cat['slug']]);
                break;
            case 'news':
                $url_cat = Url::to(['article/index', 'category_slug' => $cat['slug']]);
                break;
            default:
                $url_cat = Url::to(['product/index', 'category_slug' => $cat['slug']]);
                break;
        }

        return $url_cat;
    }
}