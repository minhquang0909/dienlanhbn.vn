<?php

namespace common\models;

use Yii;
use common\models\query\Supplier as SupplierQuery;

/**
 * This is the model class for table "supplier".
 *
 * @property int $id
 * @property string $name
 * @property string|null $email
 * @property string|null $phone
 * @property string|null $address
 * @property string|null $url
 * @property int $country_id
 * @property int $status
 * @property int $sort
 */
class Supplier extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%supplier}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name','country_id'], 'required'],
            [['status', 'sort','country_id'], 'integer'],
            [['name', 'address', 'url'], 'string', 'max' => 100],
            [['email'], 'string', 'max' => 150],
            [['phone'], 'string', 'max' => 20],
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
            'email' => Yii::t('common', 'Email'),
            'phone' => Yii::t('common', 'Phone'),
            'address' => Yii::t('common', 'Address'),
            'url' => Yii::t('common', 'Website'),
            'status' => Yii::t('common', 'Status'),
            'country_id' => Yii::t('frontend', 'Origin'),
            'sort' => Yii::t('common', 'Sort order'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return SupplierQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SupplierQuery(get_called_class());
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Country::class, ['id' => 'country_id']);
    }

}
