<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "country".
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string $name_en
 */
class Country extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%country}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'name','name_en'], 'required'],
            [['code'], 'string', 'max' => 10],
            [['name'], 'string', 'max' => 100],
            [['code'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'code' => Yii::t('common', 'Code'),
            'name' => Yii::t('common', 'Name'),
            'name_en' => Yii::t('common', 'Name in English'),
        ];
    }
    /**
     * {@inheritdoc}
     * @return \common\models\query\CountryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\CountryQuery(get_called_class());
    }
}
