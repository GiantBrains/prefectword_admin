<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "notification".
 *
 * @property int $id
 * @property string $key
 * @property string $key_id
 * @property string $type
 * @property int $user_id
 * @property int $order_number
 * @property int $seen
 * @property string $created_at
 * @property int $flashed
 */
class Notification extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notification';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['key', 'type', 'user_id', 'seen', 'created_at', 'flashed'], 'required'],
            [['user_id', 'order_number', 'seen', 'flashed'], 'integer'],
            [['created_at'], 'safe'],
            [['key', 'key_id', 'type'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'key' => 'Key',
            'key_id' => 'Key ID',
            'type' => 'Type',
            'user_id' => 'User ID',
            'order_number' => 'Order Number',
            'seen' => 'Seen',
            'created_at' => 'Created At',
            'flashed' => 'Flashed',
        ];
    }

    /**
     * @inheritdoc
     * @return NotificationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new NotificationQuery(get_called_class());
    }
}
