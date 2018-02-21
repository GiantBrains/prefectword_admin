<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "revision".
 *
 * @property int $id
 * @property int $order_number
 * @property int $new_time
 * @property string $instructions
 * @property string $created_at
 *
 * @property Urgency $newTime
 */
class Revision extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'revision';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_number', 'new_time', 'instructions'], 'required'],
            [['order_number', 'new_time'], 'integer'],
            [['instructions'], 'string'],
            [['created_at'], 'safe'],
            [['new_time'], 'exist', 'skipOnError' => true, 'targetClass' => Urgency::className(), 'targetAttribute' => ['new_time' => 'id']],
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
            'new_time' => 'New Time',
            'instructions' => 'Instructions',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNewTime()
    {
        return $this->hasOne(Urgency::className(), ['id' => 'new_time']);
    }

    /**
     * @inheritdoc
     * @return RevisionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RevisionQuery(get_called_class());
    }
}
