<?php

namespace app\models;

use dektrium\user\models\User;

/**
 * This is the model class for table "uploaded".
 *
 * @property int $id
 * @property int $order_number
 * @property int $writer_id
 * @property int $file_type
 * @property string $file_date
 * @property string $dowload_date
 * @property string $file_extension
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
            [['order_number', 'writer_id', 'file_type'], 'integer'],
            [['name'], 'required'],
            [['dowload_date', 'created_at'], 'safe'],
            [['file_extension',  'file_date'], 'string', 'max' => 50],
            [['name'],'file', 'maxSize'=>30000000, 'maxFiles' => 4],
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
            'file_type' => 'File Type',
            'file_date' => 'File Date',
            'dowload_date' => 'Dowload Date',
            'file_extension' => 'File Extension',
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
