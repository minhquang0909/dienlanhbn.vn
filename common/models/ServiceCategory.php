<?php

namespace common\models;

use common\models\query\ServiceCategoryQuery;
use Yii;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\VarDumper;

/**
 * This is the model class for table "service_category".
 *
 * @property integer $id
 * @property string $slug
 * @property string $title
 * @property integer $sort_order
 * @property integer $status
 *
 * @property ServiceCategory $parent
 */
class ServiceCategory extends ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_DRAFT = 0;
    //
    const TYPE_CATEGORY_DROPDOWN_PARENT = 1;
    const TYPE_CATEGORY_LIST = 2;
    const TYPE_CATEGORY_NORMAL = 3;
    const ROOT_CATEGORY = 0;
    //
    const HAS_CHILD_LEVEL_2 = true;    //có menu 2 cấp?
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%service_category}}';
    }

    /**
     * @return ServiceCategoryQuery
     */
    public static function find()
    {
        return new ServiceCategoryQuery(get_called_class());
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
            [['status','sort_order','parent_id'], 'integer'],
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
            'sort_order' => Yii::t('common', 'Sort order'),
            'status' => Yii::t('common', 'Active')
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServices()
    {
        return $this->hasMany(Service::class, ['category_id' => 'id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasMany(ServiceCategory::class, ['id' => 'parent_id']);
    }

    public static function getAllCategory($type = self::TYPE_CATEGORY_LIST, $reject_id = 0){
        $conn = Yii::$app->db;
        $categories = $conn->createCommand("SELECT * FROM {{%service_category}} WHERE `status` = '".(int)self::STATUS_ACTIVE."' ORDER BY `sort_order` ASC")->queryAll();
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

    public function getCatByID($id)
    {
        return self::find()->where('status=:status',[
            'status'    =>  Service::STATUS_PUBLISHED
        ])->andWhere('id=:id', ['id' => $id])->one();
    }

    public function getCatBySlug($slug)
    {
        return self::find()->where('status=:status',[
            'status'    =>  Service::STATUS_PUBLISHED
        ])->andWhere('slug=:slug', ['slug' => $slug])->one();
    }

    public function getCategoryTree($parent_id = 0){
        return $this->_getChildCategory($parent_id);
    }

    protected function _getChildCategory($parent_id = 0){
        $cat = array($parent_id);
        $childs = ServiceCategory::find()->where('parent_id=:parent_id', [
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

    public static function getChildCategoryById($cat_id){
        return self::find()->where('parent_id=:parent_id',[
            ':parent_id'    =>  $cat_id
        ])->active()->all();
    }

}
