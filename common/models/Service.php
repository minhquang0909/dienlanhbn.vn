<?php

namespace common\models;

use common\components\CFunction;
use common\models\query\ServiceQuery;
use Facebook\WebDriver\Remote\Service\DriverCommandExecutor;
use trntv\filekit\behaviors\UploadBehavior;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Query;
use yii\helpers\VarDumper;

/**
 * This is the model class for table "service".
 *
 * @property int $id
 * @property string $slug
 * @property string $title 
 * @property string $description
 * @property string|null $body
 * @property string|null $view
 * @property int|null $category_id
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
 */
class Service extends ActiveRecord
{
    const STATUS_PUBLISHED = 1;
    const STATUS_DRAFT = 0;
    const IN_OF_STOCK = 1;

    /**
     * @var array
     */

    /**
     * @var array
     */
    public $thumbnail;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%service}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id','title', 'description', 'thumbnail','body'], 'required'],
            [['category_id', 'status', 'created_by', 'updated_by', 'published_at', 'created_at', 'updated_at'], 'integer'],
            [['slug', 'thumbnail_base_url', 'thumbnail_path'], 'string', 'max' => 1024],
            [['title'], 'string', 'max' => 512],
            [['description'], 'string', 'max' => 255],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => ServiceCategory::class, 'targetAttribute' => ['category_id' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['updated_by' => 'id']],
            [['slug','title','body'], 'safe'],
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
            'title' => Yii::t('common', 'Tên dịch vụ'),            
            'description' => Yii::t('common', 'Miêu tả ngắn'),
            'body' => Yii::t('common', 'Nội dung'),
            'thumbnail' => Yii::t('common', 'Thumbnail'),
            'category_id' => Yii::t('common', 'Category'),
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
     * @return \yii\db\ActiveQuery|ServiceQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery|ServiceCategory
     */
    public function getCategory()
    {
        return $this->hasOne(ServiceCategory::class, ['id' => 'category_id']);
    }


    /**
     * Gets query for [[UpdatedBy]].
     *
     * @return \yii\db\ActiveQuery|ServiceQuery
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
    /*public function getProductAttachments()
    {
        return $this->hasMany(ProductAttachment::class, ['product_id' => 'id']);
    }*/

    /**
     * {@inheritdoc}
     * @return ServiceQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ServiceQuery(get_called_class());
    }    

    public static function countServices($category_ids=null){
        $q = new Query();
        $q->select(['id']);
        $q->from(self::tableName())->where('status=:status', [':status' => self::STATUS_PUBLISHED]);
        if($category_ids) {
            $q->andWhere(['in', 'category_id', $category_ids]);
        }
        $total = $q->count();  
        return $total;
    }


    public static function getServices($offset=0, $limit=10,$category_ids=null){
        $q = new Query();          
        $q->from(self::tableName())->where('status=:status', [':status' => self::STATUS_PUBLISHED]);
        if($category_ids) {
            $q->andWhere(['in', 'category_id', $category_ids]);
        }
        $q->limit($limit)->offset($offset);
        $q->orderBy([
            'id'    =>  SORT_DESC
        ]);
        $services = $q->all();  
        return $services;
    }    
}
