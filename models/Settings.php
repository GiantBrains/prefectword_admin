<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "settings".
 *
 * @property int $id
 * @property string $coupon1
 * @property string $coupon2
 * @property string $coupon3
 * @property double $coupon_value1
 * @property double $coupon_value2
 * @property double $coupon_value3
 * @property string $created_at
 * @property string $updated_at
 */
class Settings extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'settings';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['coupon1', 'coupon2', 'coupon3', 'coupon_value1', 'coupon_value2', 'coupon_value3'], 'required'],
            [['coupon_value1', 'coupon_value2', 'coupon_value3'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['coupon1', 'coupon2', 'coupon3'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'coupon1' => 'Coupon1',
            'coupon2' => 'Coupon2',
            'coupon3' => 'Coupon3',
            'coupon_value1' => 'Coupon Value1',
            'coupon_value2' => 'Coupon Value2',
            'coupon_value3' => 'Coupon Value3',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
