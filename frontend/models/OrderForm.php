<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * OrderForm is the model behind the contact form.
 */
class OrderForm extends Model
{
    public $fullname;
    public $phone;
    public $email;
    public $address;
    public $note;
    public $accept_policy;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['fullname', 'phone','accept_policy'], 'required'],
            // We need to sanitize them
            [['fullname', 'email', 'note'], 'filter', 'filter' => 'strip_tags'],
            // email has to be a valid email address
            ['email', 'email'],
            [['fullname','email'], 'string', 'max' => 250],
            [['phone'], 'string', 'max' => 50],
            [['note','address'], 'string', 'max' => 500],

            ['phone', 'validatePhone'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'fullname' => 'Họ và tên',
            'email' => Yii::t('frontend', 'Email'),
            'phone' => 'Số điện thoại',
            'address' => 'Địa chỉ',
            'note' => 'Ghi chú',
            'accept_policy' => 'Tôi đã đọc và đồng ý với điều khoản và điều kiện của website',
        ];
    }

    /**
     * @return bool
     */
    public function validatePhone()
    {
        if($this->phone!=""){
            if(!$this->__isPhoneNumber($this->phone)){
                $this->addError($this->phone, 'Số điện thoại không đúng định dạng');
            }
        }
        return true;
    }

    /**
     * @param $phone
     * @return bool
     */
    private function __isPhoneNumber($phone){
        if(is_numeric($phone) && (strlen($phone)==10) && (substr($phone,0,1)=='0') ){
            return true;
        }
        return false;
    }

}
