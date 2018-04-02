<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "spacing".
 *
 * @property int $id
 * @property string $name
 * @property string $created_at
 *
 * @property Order[] $orders
 * @property Pages[] $pages
 */
class Spacing extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'spacing';
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
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['spacing_id' => 'id']);
    }

    public static function getSpacings()
    {
        return self::find()->select(['name','id'])->indexBy('id')->orderBy('id ASC')->column();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPages()
    {
        return $this->hasMany(Pages::className(), ['space_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return SpacingQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SpacingQuery(get_called_class());
    }
}
