<?php
/**
 * Created by PhpStorm.
 * User: phamv
 * Date: 3/23/2022
 * Time: 9:57 AM
 */

namespace common\models;

class AirConditionerTypes{
    public static function getAllTypes(){
        return [
            [
                'id'        =>  1,
                'title'     =>  'Điều Hòa Tủ Đứng',
                'slug'      =>  'dieu-hoa-tu-dung',
                'body' => null,
                'parent_id' => 0,
                'has_level_2' => 0,
                'status' => 1,
                'sort_order' => 1,
                'created_at' => 0,
                'updated_at' => 0,
            ],
            [
                'id'        =>  2,
                'title'     =>  'Điều Hòa Âm Trần',
                'slug'      =>  'dieu-hoa-am-tran',
                'parent_id' => 0,
                'has_level_2' => 0,
                'status' => 1,
                'sort_order' => 1,
                'created_at' => 0,
                'updated_at' => 0,
            ],
            [
                'id'        =>  3,
                'title'     =>  'Điều Hòa Treo Tường',
                'slug'      =>  'dieu-hoa-treo-tuong',
                'parent_id' => 0,
                'has_level_2' => 0,
                'status' => 1,
                'sort_order' => 1,
                'created_at' => 0,
                'updated_at' => 0,
            ]
        ];
    }

    public static function getBySlug($slug){
        $model = false;
        foreach (self::getAllTypes() as $cat){
            if($slug==$cat['slug']){
                $model = $cat;
                break;
            }
        }
        return $model;
    }

    public static function getById($id){
        $model = false;
        foreach (self::getAllTypes() as $cat){
            if($id==$cat['id']){
                $model = $cat;
                break;
            }
        }
        return $model;
    }
}