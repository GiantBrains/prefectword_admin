<?php
/**
 * Created by PhpStorm.
 * User: gits
 * Date: 2/12/18
 * Time: 1:21 PM
 */

namespace app\components;

use Yii;
use app\models\Order;
use app\models\Message;
use machour\yii2\notifications\models\Notification as BaseNotification;
use yii\helpers\Url;

class Notification extends BaseNotification
{

    /**
     * A new message notification
     */
    const KEY_NEW_MESSAGE = 'new_message';
    /**
     * A meeting reminder notification
     */
    const KEY_NEW_ORDER = 'new_order_created';
    /**
     * No disk space left !
     */
    const KEY_NO_DISK_SPACE = 'no_disk_space';

    /**
     * @var array Holds all usable notifications
     */
    public static $keys = [
        self::KEY_NEW_MESSAGE,
        self::KEY_NEW_ORDER,
        self::KEY_NO_DISK_SPACE,
    ];

    /**
     * @inheritdoc
     */
    public function getTitle()
    {
        switch ($this->key) {
            case self::KEY_NEW_ORDER:
                return Yii::t('app', 'You have a new order');

            case self::KEY_NEW_MESSAGE:
                return Yii::t('app', 'You got a new message');

            case self::KEY_NO_DISK_SPACE:
                return Yii::t('app', 'No disk space left');
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
                return Yii::t('app', '{customer} has created a new order', [
                    'customer' => $order->createdBy->username
                ]);

            case self::KEY_NEW_MESSAGE:
                $message = Message::findOne($this->key_id);
                return Yii::t('app', '{customer} sent you a message', [
                    'customer' => $message->sender->username
                ]);

            case self::KEY_NO_DISK_SPACE:
                // We don't have a key_id here
                return 'Please buy more space immediately';
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

            case self::KEY_NO_DISK_SPACE:
                return 'https://aws.amazon.com/';
        };
    }

}