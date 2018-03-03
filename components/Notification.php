<?php
/**
 * Created by PhpStorm.
 * User: gits
 * Date: 2/12/18
 * Time: 2:34 PM
 */
namespace app\components;

use app\models\Withdraw;
use dektrium\user\models\User;
use Yii;
use app\models\Order;
use app\models\Message;
use machour\yii2\notifications\models\Notification as BaseNotification;

class Notification extends BaseNotification
{

    /**
     * A new message notification
     */
    const KEY_NEW_MESSAGE = 'new_message';
    const KEY_WITHDRAWAL_REQUEST = 'withdraw_request';
    const KEY_NEW_ORDER = 'new_order_created';
    const KEY_TAKE_ORDER = 'take_order';
    const KEY_ORDER_REVISION = 'order_revision';
    const KEY_ORDER_COMPLETED = 'order_completed';
    const KEY_ORDER_APPROVED = 'order_approved';
    const KEY_ORDER_REJECTED = 'order_rejected';

    /**
     * @var array Holds all usable notifications
     */
    public static $keys = [
        self::KEY_NEW_MESSAGE,
        self::KEY_NEW_ORDER,
        self::KEY_WITHDRAWAL_REQUEST,
        self::KEY_TAKE_ORDER,
        self::KEY_ORDER_REVISION,
        self::KEY_ORDER_COMPLETED,
        self::KEY_ORDER_APPROVED,
        self::KEY_ORDER_REJECTED,
    ];

    /**
     * @inheritdoc
     */
    public function getTitle()
    {
        switch ($this->key) {
            case self::KEY_NEW_ORDER:
                $order = Order::findOne($this->key_id);
                return Yii::t('app', 'New order #'.$order->ordernumber.' created');

            case self::KEY_NEW_MESSAGE:
                $mymessage = Message::find()->where(['id'=>$this->key_id])->one();
                return Yii::t('app', 'New message for order #'.$mymessage->order_number.'');

            case self::KEY_WITHDRAWAL_REQUEST:
                return Yii::t('app', 'New Withdrawal Request');

            case self::KEY_TAKE_ORDER:
                $order = Order::find()->where(['id'=>$this->key_id])->one();
                return Yii::t('app', 'Your order #'.$order->ordernumber.' has been assigned');

            case self::KEY_ORDER_REVISION:
                $order = Order::find()->where(['id'=>$this->key_id])->one();
                return Yii::t('app', 'Revision has been requested for rder #'.$order->ordernumber.'');

            case self::KEY_ORDER_COMPLETED:
                $order = Order::find()->where(['id'=>$this->key_id])->one();
                return Yii::t('app', ''.$order->ordernumber.' has been completed');

            case self::KEY_ORDER_APPROVED:
                $order = Order::find()->where(['id'=>$this->key_id])->one();
                return Yii::t('app', ''.$order->ordernumber.' has been approved');

            case self::KEY_ORDER_REJECTED:
                $order = Order::find()->where(['id'=>$this->key_id])->one();
                return Yii::t('app', ''.$order->ordernumber.' has been rejected');
        }
    }

    /**
     * @inheritdoc
     */
    public function getDescription()
    {
        switch ($this->key) {
            case self::KEY_NEW_ORDER:
                $order = Order::findOne($this->key_id);
                return Yii::t('app', '{customer} has created a new order # '.$order->ordernumber.'', [
                    'customer' => $order->createdBy->username
                ]);

            case self::KEY_NEW_MESSAGE:
                $message = Message::find()->where(['id'=>$this->key_id])->one();
                return Yii::t('app', '{customer} sent you a message for order #'.$message->order_number.'', [
                    'customer' => $message->sender->username
                ]);

            case self::KEY_WITHDRAWAL_REQUEST:
                return Yii::t('app', 'New Withdrawal Request');

            case self::KEY_TAKE_ORDER:
                // We don't have a key_id here
                $order = Order::find()->where(['id'=>$this->key_id])->one();
                return Yii::t('app', 'Your order #'.$order->ordernumber.' has been assigned');

            case self::KEY_ORDER_REVISION:
                $order = Order::find()->where(['id'=>$this->key_id])->one();
                return Yii::t('app', 'Check revision for rder #'.$order->ordernumber.'');

            case self::KEY_ORDER_COMPLETED:
                $order = Order::find()->where(['id'=>$this->key_id])->one();
                return Yii::t('app', ''.$order->ordernumber.' has been completed. Please check');

            case self::KEY_ORDER_APPROVED:
                $order = Order::find()->where(['id'=>$this->key_id])->one();
                return Yii::t('app', ''.$order->ordernumber.' has been approved');

            case self::KEY_ORDER_REJECTED:
                $order = Order::find()->where(['id'=>$this->key_id])->one();
                return Yii::t('app', ''.$order->ordernumber.' has been rejected');
        }
    }

    /**
     * @inheritdoc
     */
    public function getRoute()
    {
        switch ($this->key) {
            case self::KEY_NEW_ORDER:
                $myorder = Order::find()->where(['id'=>$this->key_id])->one();
                return Yii::$app->request->baseUrl.'/order/view?oid='.$myorder->ordernumber.'';

            case self::KEY_NEW_MESSAGE:
                $mymessage = Message::find()->where(['id'=>$this->key_id])->one();
                return Yii::$app->request->baseUrl.'/order/messages?oid='.$mymessage->order_number.'';

            case self::KEY_WITHDRAWAL_REQUEST:
                return Yii::$app->request->baseUrl.'/site/request';

            case self::KEY_TAKE_ORDER:
                $order = Order::find()->where(['id'=>$this->key_id])->one();
                return Yii::$app->request->baseUrl.'/order/view?oid='.$order->ordernumber.'';

            case self::KEY_ORDER_REVISION:
                $order = Order::find()->where(['id'=>$this->key_id])->one();
                return Yii::$app->request->baseUrl.'/order/order-revision?oid='.$order->ordernumber.'';

            case self::KEY_ORDER_COMPLETED:
                $order = Order::find()->where(['id'=>$this->key_id])->one();
                return Yii::$app->request->baseUrl.'/order/download-review?oid='.$order->ordernumber.'';

            case self::KEY_ORDER_APPROVED:
                $order = Order::find()->where(['id'=>$this->key_id])->one();
                return Yii::$app->request->baseUrl.'/order/download-review?oid='.$order->ordernumber.'';

            case self::KEY_ORDER_REJECTED:
                $order = Order::find()->where(['id'=>$this->key_id])->one();
                return Yii::$app->request->baseUrl.'/order/view?oid='.$order->ordernumber.'';
        };
    }

}