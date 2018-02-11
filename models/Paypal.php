<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "paypal".
 *
 * @property int $id
 * @property int $user_id
 * @property string $narrative
 * @property string $payment_id
 * @property int $order_number
 * @property double $amount_paid
 * @property double $withdraw
 * @property string $hash
 * @property int $complete
 * @property string $created_at
 *
 * @property User $user
 */
class Paypal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'paypal';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'order_number', 'complete'], 'integer'],
            [['amount_paid', 'withdraw'], 'number'],
            [['created_at'], 'safe'],
            [['narrative', 'payment_id', 'hash'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'narrative' => 'Narrative',
            'payment_id' => 'Payment ID',
            'order_number' => 'Order Number',
            'amount_paid' => 'Amount Paid',
            'withdraw' => 'Withdraw',
            'hash' => 'Hash',
            'complete' => 'Complete',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @inheritdoc
     * @return PaypalQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PaypalQuery(get_called_class());
    }
}
