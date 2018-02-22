<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "reject".
 *
 * @property int $id
 * @property int $order_number
 * @property string $reason
 * @property string $created_at
 */
class Reject extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reject';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_number', 'reason'], 'required'],
            [['order_number'], 'integer'],
            [['reason'], 'string'],
            [['created_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_number' => 'Order Number',
            'reason' => 'Reason',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @inheritdoc
     * @return RejectQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RejectQuery(get_called_class());
    }
}
