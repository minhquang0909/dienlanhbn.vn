<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "product_order_items".
 *
 * @property int $id
 * @property int $order_id
 * @property int $product_id
 * @property string $title
 * @property int $quantity
 * @property float $price
 * @property float|null $discount_price
 * @property string|null $discount_reason
 * @property int|null $created_at
 * @property int $updated_at
 */
class ProductOrderItems extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%product_order_items}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_id', 'product_id', 'title', 'quantity', 'price'], 'required'],
            [['order_id', 'product_id', 'quantity', 'created_at', 'updated_at'], 'integer'],
            [['price', 'discount_price'], 'number'],
            [['title'], 'string', 'max' => 250],
            [['discount_reason'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'Order ID',
            'product_id' => 'Product ID',
            'title' => 'Title',
            'quantity' => 'Quantity',
            'price' => 'Price',
            'discount_price' => 'Discount Price',
            'discount_reason' => 'Discount Reason',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\ProductOrderItemsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\ProductOrderItemsQuery(get_called_class());
    }
}
