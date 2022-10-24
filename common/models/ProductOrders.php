<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "product_orders".
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $fullname
 * @property string $phone
 * @property string|null $email
 * @property string|null $address
 * @property int $quantity
 * @property int $total_amount
 * @property string|null $created_ip
 * @property string|null $gift_code
 * @property int|null $gift_code_value
 * @property string|null $ship_code
 * @property int|null $ship_cost
 * @property int|null $ship_cost_real
 * @property string|null $from
 * @property string|null $utm_source
 * @property string|null $utm_medium
 * @property string|null $utm_campaign
 * @property string|null $utm_content
 * @property string|null $order_key
 * @property string|null $note
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 */
class ProductOrders extends \yii\db\ActiveRecord
{
    const STATUS_NEW = 1;
    const STATUS_PROCESSING= 2;
    const STATUS_CANCEL = 3;
    const STATUS_FINISHED = 4;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%product_orders}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'quantity', 'total_amount', 'gift_code_value', 'ship_cost', 'ship_cost_real', 'status', 'created_at', 'updated_at'], 'integer'],
            [['fullname', 'phone', 'quantity', 'total_amount'], 'required'],
            [['from'], 'string'],
            [['fullname', 'email'], 'string', 'max' => 250],
            [['phone', 'created_ip', 'gift_code', 'ship_code'], 'string', 'max' => 50],
            [['address'], 'string', 'max' => 500],
            [['order_key'], 'string', 'max' => 255],
            [['utm_source', 'utm_medium', 'utm_campaign', 'utm_content','note'], 'string', 'max' => 512],
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
            'user_id' => 'User ID',
            'fullname' => 'Họ và tên',
            'phone' => 'Phone',
            'email' => 'Email',
            'address' => 'Địa chỉ',
            'quantity' => 'Số lượng SP',
            'total_amount' => 'Tổng tiền',
            'created_ip' => 'IP',
            'gift_code' => 'Gift Code',
            'gift_code_value' => 'Gift Code Value',
            'ship_code' => 'Ship Code',
            'ship_cost' => 'Ship Cost',
            'ship_cost_real' => 'Ship Cost Real',
            'from' => 'From',
            'utm_source' => 'Utm Source',
            'utm_medium' => 'Utm Medium',
            'utm_campaign' => 'Utm Campaign',
            'utm_content' => 'Utm Content',
            'status' => 'Trạng thái',
            'order_key' => 'order_key',
            'note' => 'Ghi chú',
            'created_at' => 'Ngày tạo',
            'updated_at' => 'Ngày cập nhật',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\ProductOrdersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\ProductOrdersQuery(get_called_class());
    }

    /**
     * Returns user statuses list
     * @return array|mixed
     */
    public static function statuses()
    {
        return [
            self::STATUS_NEW => 'Mới',
            self::STATUS_PROCESSING => 'Đang xử lý',
            self::STATUS_CANCEL => 'Đã hủy',
            self::STATUS_FINISHED => 'Hoàn thành',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(ProductOrderItems::className(), ['order_id' => 'id']);
    }
}
