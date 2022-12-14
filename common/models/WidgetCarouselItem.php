<?php

namespace common\models;

use common\behaviors\CacheInvalidateBehavior;
use trntv\filekit\behaviors\UploadBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "widget_carousel_item".
 *
 * @property integer $id
 * @property integer $carousel_id
 * @property string $base_url
 * @property string $path
 * @property string $type
 * @property string $title
 * @property string $image
 * @property string $imageUrl
 * @property string $url
 * @property string $caption
 * @property integer $status
 * @property integer $order
 *
 * @property WidgetCarousel $carousel
 */
class WidgetCarouselItem extends ActiveRecord
{

    /**
     * @var array|null
     */
    public $image;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%widget_carousel_item}}';
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $key = array_search('carousel_id', $scenarios[self::SCENARIO_DEFAULT], true);
        $scenarios[self::SCENARIO_DEFAULT][$key] = '!carousel_id';
        return $scenarios;
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            [
                'class' => UploadBehavior::class,
                'attribute' => 'image',
                'pathAttribute' => 'path',
                'baseUrlAttribute' => 'base_url',
                'typeAttribute' => 'type'
            ],
            'cacheInvalidate' => [
                'class' => CacheInvalidateBehavior::class,
                'cacheComponent' => 'frontendCache',
                'keys' => [
                    function ($model) {
                        return [
                            WidgetCarousel::class,
                            $model->carousel->key
                        ];
                    }
                ]
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['carousel_id'], 'required'],
            [['carousel_id', 'status', 'order'], 'integer'],
            [['url', 'caption', 'base_url', 'path'], 'string', 'max' => 1024],
            [['type','title'], 'string', 'max' => 255],
            ['image', 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'carousel_id' => Yii::t('common', 'Carousel ID'),
            'image' => Yii::t('common', 'Image'),
            'base_url' => Yii::t('common', 'Base URL'),
            'path' => Yii::t('common', 'Image'),
            'type' => Yii::t('common', 'File Type'),
            'title' => Yii::t('common', 'Title'),
            'url' => Yii::t('common', 'Url'),
            'caption' => Yii::t('common', 'Description'),
            'status' => Yii::t('common', 'Status'),
            'order' => Yii::t('common', 'Order')
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCarousel()
    {
        return $this->hasOne(WidgetCarousel::class, ['id' => 'carousel_id']);
    }

    /**
     * @return string
     */
    public function getImageUrl()
    {
        return rtrim($this->base_url, '/') . '/' . ltrim($this->path, '/');
    }

    public static function getBannerByPosition($position,$limit=5, $offset=0){
        $banners = WidgetCarouselItem::getDb()->cache(function () use ($position, $offset, $limit) {
            return WidgetCarouselItem::find()
                ->joinWith('carousel')
                ->where([
                    '{{%widget_carousel_item}}.status' => WidgetCarousel::STATUS_ACTIVE,
                    '{{%widget_carousel}}.status' => WidgetCarousel::STATUS_ACTIVE,
                    '{{%widget_carousel}}.key' => $position,
                ])->limit($limit)->offset($offset)
                ->orderBy(['order' => SORT_ASC, 'id' => SORT_DESC])->all();
        }, Yii::$app->params['cache_time']);
        return $banners;
    }
}
