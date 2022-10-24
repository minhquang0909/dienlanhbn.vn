<?php

namespace common\models;

use common\components\CFunction;
use common\models\query\ProductQuery;
use trntv\filekit\behaviors\UploadBehavior;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Query;
use yii\helpers\VarDumper;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $slug
 * @property string $title
 * * @property float $price
 * * @property float $price_discount
 * @property string $features
 * @property string|null $body
 * @property int|null $category_id
 * @property int|null $air_conditioner_types
 * @property string|null $image_list json image trong gallery
 * @property string|null $thumbnail_base_url
 * @property string|null $thumbnail_path
 * @property int $status
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $published_at
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property User $createdBy
 * @property ProductCategory $category
 * @property User $updatedBy
 * @property ProductAttachment[] $productAttachments
 */
class Product extends ActiveRecord
{
    const STATUS_PUBLISHED = 1;
    const STATUS_DRAFT = 0;

    /**
     * @var array
     */

    /**
     * @var array
     */
    public $thumbnail;
    public $new_image_list;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%product}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['slug', 'category_id', 'title', 'price','thumbnail','features','body'], 'required'],
            [['body', 'image_list'], 'string'],
            [['price', 'price_discount'], 'number'],
            [['category_id', 'air_conditioner_types', 'status', 'created_by', 'updated_by', 'published_at', 'created_at', 'updated_at'], 'integer'],
            [['slug', 'thumbnail_base_url', 'thumbnail_path'], 'string', 'max' => 1024],
            [['title','features'], 'string', 'max' => 512],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductCategory::class, 'targetAttribute' => ['category_id' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['updated_by' => 'id']],
            [['slug', 'title','image_list', 'thumbnail', 'body', 'features'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            BlameableBehavior::class,
            [
                'class' => SluggableBehavior::class,
                'attribute' => 'title',
                'immutable' => true
            ],

            [
                'class' => UploadBehavior::class,
                'attribute' => 'thumbnail',
                'pathAttribute' => 'thumbnail_path',
                'baseUrlAttribute' => 'thumbnail_base_url'
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'slug' => Yii::t('common', 'Slug'),
            'price' => 'Giá gốc',
            'price_discount' => 'Giá khuyến mãi',
            'title' => Yii::t('common', 'Product name'),
            'features' => Yii::t('common', 'Tính năng, đặc điểm'),
            'body' => Yii::t('common', 'Mô tả'),
            'thumbnail' => Yii::t('common', 'Thumbnail'),
            'category_id' => Yii::t('common', 'Category'),
            'air_conditioner_types' => Yii::t('common', 'Loại điều hòa'),
            'image_list' => Yii::t('common', 'Product images max 5'),
            'new_image_list' => Yii::t('common', 'Add new image for product'),
            'status' => Yii::t('common', 'Published'),
            'published_at' => Yii::t('common', 'Published At'),
            'created_by' => Yii::t('common', 'Author'),
            'updated_by' => Yii::t('common', 'Updater'),
            'created_at' => Yii::t('common', 'Created At'),
            'updated_at' => Yii::t('common', 'Updated At'),
            'thumbnail_base_url' => Yii::t('common', 'Thumbnail Base Url'),
            'thumbnail_path' => Yii::t('common', 'Thumbnail Path'),
        ];
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery|ProductCategoryQuery
     */
    public function getCategory()
    {
        return $this->hasOne(ProductCategory::class, ['id' => 'category_id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountries()
    {
        return $this->hasOne(Country::class, ['id' => 'country']);
    }

    public function getSupply()
    {
        return $this->hasOne(Supplier::class, ['id' => 'supplier']);
    }

    /**
     * Gets query for [[UpdatedBy]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'updated_by']);
    }

    /**
     * Gets query for [[ProductAttachments]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getProductAttachments()
    {
        return $this->hasMany(ProductAttachment::class, ['product_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return ProductQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductQuery(get_called_class());
    }


    public static function findNextPreviousProduct($id,$category_id, $next=true)
    {
        $q = new Query();
        $q->from(self::tableName());
        $q->where('1=1');

        $q->andWhere(['=', 'category_id',$category_id]);
        if($next){
            $q->andWhere(['>', 'id',$id]);
        }else{
            $q->andWhere(['<', 'id',$id]);
        }

        return $q->one();
    }


    public static function countProducts($category_ids=null,$air_conditioner_types=null,$title="",  $product_ids=[])
    {

        $q = new Query();
        $q->select(['c.id']);
        $q->from(['p' => self::tableName()])->leftJoin(['c' => ProductCategory::tableName()],'p.category_id=c.id');
        $q->where('1=1');

        if($category_ids) {
            $q->andWhere(['in', 'c.id', $category_ids]);
        }
        if($air_conditioner_types){
            $q->andWhere('p.air_conditioner_types=:air_conditioner_types', [
                ':air_conditioner_types'    =>  $air_conditioner_types
            ]);
        }
        if($title!=""){
            $q->andWhere(['LIKE', 'p.title', $title]);
        }
        if(is_array($product_ids) && count($product_ids) >0){
            $q->andWhere(['in', 'p.id', $product_ids]);
        }

        $count = $q->count();

        return $count;
    }

    public static function getProducts($offset=0, $limit=10,$sort="date",$category_ids=null,$air_conditioner_types=null,$title="", $product_ids=[]){
        $limit = ($limit > 0)?$limit:1;
        $offset = ($offset > 0)?$offset:0;

        $q = new Query();
        $q->select(['p.id','p.slug','p.title','p.price','p.price_discount','p.thumbnail_path','p.thumbnail_base_url', 'c.title AS cat_title']);
        $q->from(['p' => self::tableName()])->leftJoin(['c' => ProductCategory::tableName()],'p.category_id=c.id');
        $q->where('p.status=:status',[':status' => self::STATUS_PUBLISHED]);
        switch ($sort){
            case 'price':
                $q->orderBy([
                    'p.price' => SORT_ASC,
                ]);
                break;
            case 'price-desc':
                $q->orderBy([
                    'p.price' => SORT_DESC,
                ]);
                break;
            default:
                $q->orderBy([
                    'p.id' => SORT_DESC,
                ]);
                break;
        }
        if($category_ids) {
            $q->andWhere(['in', 'c.id', $category_ids]);
        }
        if($air_conditioner_types){
            $q->andWhere('p.air_conditioner_types=:air_conditioner_types', [
                ':air_conditioner_types'    =>  $air_conditioner_types
            ]);
        }
        if($title!=""){
            $q->andWhere(['LIKE', 'p.title', $title]);
        }

        if(is_array($product_ids) && count($product_ids) >0){
            $q->andWhere(['in', 'p.id', $product_ids]);
        }


        $q->limit($limit)->offset($offset);
        $products = $q->all();

        return $products;
    }

    public static function getRelateProducts($model,$limit=10){
        $q = new Query();
        $q->select(['p.id','p.slug','p.title','p.price','p.price_discount','p.thumbnail_path','p.thumbnail_base_url', 'c.title AS cat_title']);
        $q->from(['p' => self::tableName()])->leftJoin(['c' => ProductCategory::tableName()],'p.category_id=c.id');
        $q->where('p.status=:status',[':status' => self::STATUS_PUBLISHED]);
        $q->andWhere(['<>', 'p.id', $model['id']??0]);
        $q->andWhere([
            'c.id' => $model['category_id']??0,
        ]);
        $q->orWhere([
            'p.air_conditioner_types' => $model['air_conditioner_types']??0,
        ]);
        $q->limit($limit);
        return $q->all();
    }
}
