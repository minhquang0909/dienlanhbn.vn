<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "languages".
 *
 * @property int $id
 * @property string $title
 * @property string $code
 * @property string|null $flag
 * @property int $sort_order
 * @property int $status
 */
class Languages extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'languages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'code'], 'required'],
            [['flag'], 'string'],
            [['sort_order', 'status'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['code'], 'string', 'max' => 100],
            [['code'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'code' => Yii::t('app', 'Code'),
            'flag' => Yii::t('app', 'Flag'),
            'sort_order' => Yii::t('app', 'Sort Order'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\LanguagesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\LanguagesQuery(get_called_class());
    }

    public static function getAllLanguages(){
        return self::find()->active()->orderBy(['sort_order'=>SORT_ASC])->all();
    }

    public static function getArrayLanguages(){
        $result = [];
        $rs = self::find()->active()->orderBy(['sort_order'=>SORT_ASC])->select('code')->all();
        if(is_array($rs) && count($rs) > 0){
            foreach ($rs as $i){
                $result[] = $i->code;
            }
        }
        return $result;
    }
}
