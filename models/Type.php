<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "type".
 *
 * @property int $id
 * @property string $name
 * @property string $created_at
 *
 * @property Frontorder[] $frontorders
 * @property Order[] $orders
 */
class Type extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'created_at' => 'Created At',
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFrontorders()
    {
        return $this->hasMany(Frontorder::className(), ['type_id' => 'id']);
    }

    public static function getTypes()
    {
        return self::find()->select(['name','id'])->indexBy('id')->orderBy('name ASC')->column();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['type_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return TypeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TypeQuery(get_called_class());
    }
}
