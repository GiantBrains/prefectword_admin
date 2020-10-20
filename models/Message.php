<?php

namespace app\models;

use app\models\User;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "message".
 *
 * @property integer $id
 * @property integer $general
 * @property integer $status
 * @property string $title
 * @property string $context
 * @property integer $sender_id
 * @property integer $receiver_id
 * @property integer $order_number
 * @property string $message
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
            [['general', 'status', 'sender_id', 'receiver_id','order_number'], 'integer'],
            [['message'], 'required'],
            [['message'], 'string'],
            [['created_at'], 'safe'],
            [['title', 'context'], 'string', 'max' => 255],
            [['sender_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['sender_id' => 'id']],
            [['receiver_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['receiver_id' => 'id']],
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
            'status' => 'Status',
            'title' => 'Title',
            'context' => 'Context',
            'sender_id' => 'Sender ID',
            'receiver_id' => 'Receiver ID',
            'order_number' => 'Order Number',
            'message' => 'Message',
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

    public static function testArrayMap(){
        $orders = Order::find()->all();
        $myOrders = [];
        $orderResults = ArrayHelper::index($orders, 'id');
        $users = User::find()->all();
        $userResults = ArrayHelper::index($users, 'id');
        foreach ($orderResults as $orderResult) {
            $myOrders[] = $userResults[$orderResult['created_by']];
        }

        return $myOrders;
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
