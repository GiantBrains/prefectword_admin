<?php

namespace app\models;

use dektrium\user\models\User;

/**
 * This is the model class for table "wallet".
 *
 * @property int $id
 * @property int $customer_id
 * @property int $order_id
 * @property double $deposit
 * @property double $withdraw
 * @property string $narrative
 * @property string $created_at
 *
 * @property User $customer
 */
class Wallet extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wallet';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id', 'order_id'], 'integer'],
            [['deposit', 'withdraw'], 'number'],
            [['created_at'], 'safe'],
            [['narrative'], 'string', 'max' => 255],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['customer_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'customer_id' => 'Customer ID',
            'order_id' => 'Order ID',
            'deposit' => 'Deposit',
            'withdraw' => 'Withdraw',
            'narrative' => 'Narrative',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(User::className(), ['id' => 'customer_id']);
    }

    /**
     * @inheritdoc
     * @return WalletQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new WalletQuery(get_called_class());
    }
}
