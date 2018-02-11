<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "urgency".
 *
 * @property int $id
 * @property string $name
 * @property string $created_at
 *
 * @property Frontorder[] $frontorders
 * @property Order[] $orders
 */
class Urgency extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'urgency';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFrontorders()
    {
        return $this->hasMany(Frontorder::className(), ['urgency_id' => 'id']);
    }

    public static function getUrgency()
    {
        return self::find()->select(['name','id'])->indexBy('id')->orderBy('id ASC')->column();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['urgency_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return UrgencyQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UrgencyQuery(get_called_class());
    }
}
