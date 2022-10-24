<?php

namespace common\models;

use Yii;
use trntv\filekit\behaviors\UploadBehavior;

/**
 * This is the model class for table "support".
 *
 * @property int $id
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property string $thumbnail_base_url
 * @property string $thumbnail_path
 * @property int $status
 */
class Support extends \yii\db\ActiveRecord
{
    const STATUS_PUBLISHED = 1;
    const STATUS_DRAFT = 0;

    /**
     * @var array
     */
    public $thumbnail;
    /**
     * {@inheritdoc}
     */

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%support}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'phone', 'thumbnail', 'email'], 'required'],
            [['status'], 'integer'],
            [['name', 'email'], 'string', 'max' => 100],
            [['phone'], 'string', 'max' => 50],
            [['thumbnail_base_url', 'thumbnail_path'], 'string', 'max' => 1024],
            [['thumbnail'], 'safe'],
            ['email', 'email'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
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
            'name' => Yii::t('common', 'Name'),
            'phone' => Yii::t('common', 'Phone'),
            'email' => Yii::t('common', 'Email'),
            'thumbnail_base_url' => Yii::t('common', 'Thumbnail Base Url'),
            'thumbnail_path' => Yii::t('common', 'Thumbnail Path'),
            'thumbnail' => Yii::t('common', 'Thumbnail'),
            'status' => Yii::t('common', 'Published'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\SupportQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\SupportQuery(get_called_class());
    }

    public static function getList($limit=3){
        $ckey = md5('Support_getList'."_".$limit);
        $ctime = Yii::$app->params['cache_time'];
        $cache = Yii::$app->cache;
        $rs = $cache->get($ckey);
        if(!$rs){
            $rs = self::find()->active()->limit($limit)->all();
            $cache->set($ckey,$rs,$ctime);
        }
        return $rs;
    }
}
