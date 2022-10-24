<?php

namespace common\models;
use common\models\query\QueueEmailQuery;
use Yii;

/**
 * This is the model class for table "queue_email".
 *
 * @property string $id
 * @property string $type
 * @property string $email
 * @property string $content
 * @property string $created_date
 */
class QueueEmail extends \yii\db\ActiveRecord
{
    const TYPE_CONTACT = 'contact';
    const TYPE_GENERAL = 'general';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%queue_email}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'email', 'content', 'created_date'], 'required'],
            [['type', 'content'], 'string'],
            [['created_date'], 'integer'],
            [['email'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'type' => Yii::t('common', 'Type'),
            'email' => Yii::t('common', 'Email'),
            'content' => Yii::t('common', 'Content'),
            'created_date' => Yii::t('common', 'Created Date'),
        ];
    }

    /**
     * @inheritdoc
     * @return QueueEmailQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new QueueEmailQuery(get_called_class());
    }
}
