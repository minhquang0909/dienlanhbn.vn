<?php

namespace common\models;

use common\models\query\ProductCategoryQuery;
use Yii;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Query;
use yii\helpers\VarDumper;

/**
 * This is the model class for table "product_category".
 *
 * @property integer $id
 * @property string $slug
 * @property string $title
 * @property integer $sort_order
 * @property integer parent_id
 * @property integer $has_level_2
 * @property integer $status
 *
 * @property Product[] $product
 * @property ProductCategory $parent
 */
class ProductCategory extends ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_DRAFT = 0;
    //
    const TYPE_CATEGORY_DROPDOWN_PARENT = 1;
    const TYPE_CATEGORY_LIST = 2;
    const TYPE_CATEGORY_NORMAL = 3;
    //
    const CATEGORY_PLASTIC_MATERIALS = 1;   //nguyên liệu nhựa
    const CATEGORY_PLASTIC_PRODUCT = 2;   //thành phẩm nhựa
    const ROOT_CATEGORY = 0;

    const HAS_CHILD_LEVEL_2 = 1;    //có menu 2 cấp?
    const  LIMIT_FOR_CAT_MENU  = 8;
    const  MAX_LIMIT_FOR_CAT_MENU  = 11;
    const  CAT_AIRCONDITIONER_SLUG  = 'dieu-hoa';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%product_category}}';
    }

    /**
     * @return ProductCategoryQuery
     */
    public static function find()
    {
        return new ProductCategoryQuery(get_called_class());
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            [
                'class' => SluggableBehavior::class,
                'attribute' => 'title',
                'immutable' => true
            ]
        ];
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title','sort_order'],'required'],
            [['title'], 'string', 'max' => 512],
            [['slug'], 'unique'],
            [['slug'], 'string', 'max' => 1024],
            [['status','sort_order','parent_id','has_level_2'], 'integer'],
            //['parent_id', 'exist', 'targetClass' => ProductCategory::class, 'targetAttribute' => 'id']
            [['sort_order','parent_id'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'slug' => Yii::t('common', 'Slug'),
            'title' => Yii::t('common', 'Title'),
            'parent_id' => Yii::t('common', 'Parent Category'),
            'has_level_2' => 'Có cháu nội hay không?',
            'sort_order' => Yii::t('common', 'Sort order'),
            'status' => Yii::t('common', 'Active')
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::class, ['category_id' => 'id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasMany(ProductCategory::class, ['id' => 'parent_id']);
    }

    public static function getAllCategory($type = self::TYPE_CATEGORY_LIST, $reject_id = 0){
        $conn = Yii::$app->db;
        $categories = $conn->createCommand("SELECT * FROM {{%product_category}} WHERE `status` = '".(int)self::STATUS_ACTIVE."' ORDER BY `sort_order` ASC")->queryAll();
        if(is_array($categories) && count($categories) > 0){
            $allCategory = array();
            foreach($categories as $item){
                $allCategory[$item['id']] = $item;
            }
            if($type == self::TYPE_CATEGORY_LIST){
                $categories = get_list_category_sorted(0, 0, $allCategory);
            }else if($type == self::TYPE_CATEGORY_DROPDOWN_PARENT){
                $categories = get_list_category_sorted(0, 0, $allCategory, $reject_id);
            }else{
                $categories = $allCategory;
            }
            //
            return $categories;
        }else{
            return false;
        }
    }

    /**Danh mục 3 cấp
     * @param $category_id
     * @return int|mixed
     */
    public static function getCategoryLevel_1($category_id){
        $root_category_id = 1;
        if($category_id > 0){
            $category_level_3 = self::find()->where(['id'=>$category_id])->one();
            if(isset($category_level_3['parent_id']) && $category_level_3['parent_id'] > 0){
                $root_category_id = $category_level_3['parent_id']??0;
                $category_level_2 = self::find()->where(['id'=>$root_category_id])->one();
                if(isset($category_level_2['parent_id']) && $category_level_2['parent_id'] > 0){
                    $root_category_id = $category_level_2['parent_id']??0;
                }
            }
        }
        return $root_category_id;
    }

    public function getCatByID($id)
    {
        return self::find()->where('status=:status',[
            'status'    =>  Service::STATUS_PUBLISHED
        ])->active()->andWhere('id=:id', ['id' => $id])->one();
    }

    public function getCatBySlug($slug)
    {
        return self::find()->where('status=:status',[
            'status'    =>  Service::STATUS_PUBLISHED
        ])->active()->andWhere('slug=:slug', ['slug' => $slug])->one();
    }

    public function getCategoryTree($parent_id = 0){
        return $this->_getChildCategory($parent_id);
    }

    protected function _getChildCategory($parent_id = 0){
        $cat = array($parent_id);
        $childs = ProductCategory::find()->where('parent_id=:parent_id', [
            ':parent_id'    =>  $parent_id
        ])->all();
        if ($childs) {
            foreach ($childs as $item) {
                $cat[] = $item['id'];
                $child = $this->_getChildCategory($item['id']);
                if (is_array($child) && count($child) > 0) {
                    $cat = array_merge($cat, $child);
                }
            }
        }
        return array_unique($cat);
    }

    public function getCategoryTreeReverse($category){
        $cat = array($category);
        return array_merge($cat, $this->_getCategoryParent($category));
    }

    protected function _getCategoryParent($parent){
        $cat = array();
        $parent = $this->getCatBySlug($parent['parent_id']);
        if($parent){
            $parent = array(
                'id' => $parent['id'],
                'parent_id' => $parent['parent_id'],
                'slug' => $parent['slug'],
                'sort_order' => $parent['sort_order'],
                'title' => $parent['title']
            );
        }
        if($parent){
            $cat[] = $parent;
            if($parent['parent_id'] > 0){
                $parents = $this->_getCategoryParent($parent);
                $cat = array_merge($cat, $parents);
            }
        }
        return $cat;
    }

    public static function getAirCategoryList($offset=0, $limit=10, $slug=self::CAT_AIRCONDITIONER_SLUG){
        $categories = [];
        $category = self::find()->where('slug=:slug',[
            ':slug'    =>  $slug
        ])->active()->one();
        if($category){    
        return self::find()->where('parent_id=:parent_id',[
            ':parent_id'    =>  $category['id']??0
            ])->active()->orderBy([
                'sort_order'    =>  SORT_ASC
            ])->offset($offset)->limit($limit)->all();
        }
        return $categories;
    }
    
    public static function getChildCategoryById($cat_id){
        return self::find()->where('parent_id=:parent_id',[
            ':parent_id'    =>  $cat_id
        ])->active()->all();
    }


    public static function countChildsCategory($category){
        return (int)self::find()->where('parent_id=:parent_id',[
            ':parent_id'    =>  $category['id']??0,
        ])->active()->count();
    }


    public static function getCategoryByIds($category_ids=[]){
        $categories = [];
        if(is_array($category_ids) && count($category_ids) > 0){
            foreach ($category_ids as $id){
                echo $id."<hr>";
                $categories[] = self::getCatByID($id);
            }
        }
        return $categories;
    }

}
