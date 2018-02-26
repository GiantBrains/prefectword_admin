<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "revision".
 *
 * @property int $id
 * @property int $order_number
 * @property string $instructions
 * @property string $created_at
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
            [['order_number', 'instructions'], 'required'],
            [['order_number'], 'integer'],
            [['instructions'], 'string'],
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
            'order_number' => 'Order Number',
            'instructions' => 'Instructions',
            'created_at' => 'Created At',
        ];
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
