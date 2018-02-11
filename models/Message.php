<?php

namespace app\models;

use dektrium\user\models\User;

/**
 * This is the model class for table "message".
 *
 * @property int $id
 * @property int $general
 * @property int $sender_id
 * @property int $receiver_id
 * @property int $order_number
 * @property string $message
 * @property int $read
 * @property string $created_at
 *
 * @property User $sender
 * @property User $receiver
 */
class Message extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'message';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['general', 'sender_id', 'receiver_id', 'order_number', 'status'], 'integer'],
            [['sender_id', 'receiver_id', 'message','status'], 'required'],
            [['message', 'title', 'context'], 'string'],
            [['created_at'], 'safe'],
            [['sender_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['sender_id' => 'id']],
            [['receiver_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['receiver_id' => 'id']],
            [['order_number'], 'exist', 'skipOnError' => true, 'targetClass' => Order::className(), 'targetAttribute' => ['order_number' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'general' => 'General',
            'sender_id' => 'Sender ID',
            'receiver_id' => 'Receiver ID',
            'order_number' => 'Order Number',
            'message' => 'Message',
            'read' => 'Read',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSender()
    {
        return $this->hasOne(User::className(), ['id' => 'sender_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReceiver()
    {
        return $this->hasOne(User::className(), ['id' => 'receiver_id']);
    }

    /**
     * @inheritdoc
     * @return MessageQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MessageQuery(get_called_class());
    }
}
