<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "uniqueid".
 *
 * @property int $id
 * @property int $orderid
 */
class Uniqueid extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'uniqueid';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['orderid'], 'required'],
            [['orderid'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'orderid' => 'Orderid',
        ];
    }

    /**
     * @inheritdoc
     * @return UniqueidQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UniqueidQuery(get_called_class());
    }
}
