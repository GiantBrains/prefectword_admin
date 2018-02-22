<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cancel".
 *
 * @property int $id
 * @property int $order_number
 * @property int $title
 * @property string $description
 * @property string $created_at
 *
 * @property Reason $title0
 */
class Cancel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cancel';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_number', 'title', 'description'], 'required'],
            [['order_number', 'title'], 'integer'],
            [['description'], 'string'],
            [['created_at'], 'safe'],
            [['title'], 'exist', 'skipOnError' => true, 'targetClass' => Reason::className(), 'targetAttribute' => ['title' => 'id']],
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
            'title' => 'Title',
            'description' => 'Description',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTitle0()
    {
        return $this->hasOne(Reason::className(), ['id' => 'title']);
    }

    /**
     * @inheritdoc
     * @return CancelQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CancelQuery(get_called_class());
    }
}
