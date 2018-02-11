<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "language".
 *
 * @property int $id
 * @property string $name
 * @property string $created_at
 *
 * @property Order[] $orders
 */
class Language extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'language';
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
        return $this->hasMany(Order::className(), ['language_id' => 'id']);
    }


    public static function getLanguages()
    {
        return self::find()->select(['name','id'])->indexBy('id')->orderBy('id ASC')->column();
    }

    /**
     * @inheritdoc
     * @return LanguageQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LanguageQuery(get_called_class());
    }
}
