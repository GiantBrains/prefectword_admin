<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "withdraw".
 *
 * @property int $id
 * @property int $status
 * @property int $user_id
 * @property double $amount
 * @property string $created_at
 */
class Withdraw extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'withdraw';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'user_id', 'amount'], 'required'],
            [['status', 'user_id'], 'integer'],
            [['amount'], 'number'],
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
            'status' => 'Status',
            'user_id' => 'User ID',
            'amount' => 'Amount',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @inheritdoc
     * @return WithdrawQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new WithdrawQuery(get_called_class());
    }
}
