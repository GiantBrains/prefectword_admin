<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "whycancel".
 *
 * @property int $id
 * @property string $name
 * @property string $created_at
 *
 * @property Cancel[] $cancels
 */
class Whycancel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'whycancel';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
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
    public function getCancels()
    {
        return $this->hasMany(Cancel::className(), ['title' => 'id']);
    }

    /**
     * @inheritdoc
     * @return WhycancelQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new WhycancelQuery(get_called_class());
    }
}
