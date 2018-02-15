<?php

namespace app\models;

use dektrium\user\models\User;

/**
 * This is the model class for table "uploaded".
 *
 * @property int $id
 * @property int $order_number
 * @property int $writer_id
 * @property string $name
 * @property string $created_at
 *
 * @property Order $orderNumber
 * @property User $writer
 */
class Uploaded extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'uploaded';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_number', 'writer_id'], 'integer'],
            [['name'], 'required'],
            [['created_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['order_number'], 'exist', 'skipOnError' => true, 'targetClass' => Order::className(), 'targetAttribute' => ['order_number' => 'id']],
            [['writer_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['writer_id' => 'id']],
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
            'writer_id' => 'Writer ID',
            'name' => 'Name',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderNumber()
    {
        return $this->hasOne(Order::className(), ['id' => 'order_number']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWriter()
    {
        return $this->hasOne(User::className(), ['id' => 'writer_id']);
    }

    /**
     * @inheritdoc
     * @return UploadedQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UploadedQuery(get_called_class());
    }
}
