<?php

namespace common\models;
use common\models\query\ContactQuery;

use Yii;

/**
 * This is the model class for table "contact".
 *
 * @property string $id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property integer $product_id
 * @property string $content
 * @property integer $created_time
 * @property integer $update_time
 * @property integer $status
 * @property string $note
 */
class Contact extends \yii\db\ActiveRecord
{
    const STATUS_NEW = 0;   //mới
    const STATUS_READ = 1;  //Đã xem
    const STATUS_DONE = 2;  //Đã liên hệ
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%contact}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'phone', 'content','product_id'], 'required'],
            [['product_id', 'phone','created_time', 'update_time', 'status'], 'integer'],
            ['email', 'email'],
            [['note'], 'string'],
            [['name', 'email'], 'string', 'max' => 100],
            [['phone'], 'string', 'max' => 10],
            [['content'], 'string', 'max' => 500],
            ['phone','validatePhone']
        ];
    }


    public function validatePhone(){
        $phone = $this->phone;
        if(is_numeric($phone) && strlen($phone)==10){

        }else{
            $this->addError($this->phone, 'Số điện thoại không đúng');
        }
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => Yii::t('frontend','Fullname'),
            'email' => Yii::t('frontend','Email'),
            'phone' => Yii::t('frontend','Phone'),
            'product_id' => Yii::t('frontend','Product'),
            'content' => Yii::t('frontend','Content'),
            'created_time' => Yii::t('frontend','Created time'),
            'update_time' => Yii::t('frontend','Update time'),
            'status' => Yii::t('frontend','Status'),
            'note' => Yii::t('frontend','Note'),
        ];
    }

    /**
     * @inheritdoc
     * @return ContactQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ContactQuery(get_called_class());
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::class, ['id' => 'product_id']);
    }
    public function contact($email)
    {
        if ($this->validate()) {
            return Yii::$app->mailer->compose()
                ->setTo($email)
                ->setFrom(Yii::$app->params['robotEmail'])
                ->setReplyTo([$this->email => $this->name])
                ->setSubject($this->subject)
                ->setTextBody($this->body)
                ->send();
        } else {
            return false;
        }
    }
}
