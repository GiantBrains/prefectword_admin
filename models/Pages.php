<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pages".
 *
 * @property int $id
 * @property string $name
 * @property int $no_of_page
 * @property int $space_id
 * @property string $created_at
 *
 * @property Frontorder[] $frontorders
 * @property Order[] $orders
 * @property Spacing $space
 */
class Pages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['no_of_page', 'space_id'], 'integer'],
            [['created_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['space_id'], 'exist', 'skipOnError' => true, 'targetClass' => Spacing::className(), 'targetAttribute' => ['space_id' => 'id']],
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
            'no_of_page' => 'No Of Page',
            'space_id' => 'Space ID',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFrontorders()
    {
        return $this->hasMany(Frontorder::className(), ['pages_id' => 'id']);
    }

    public static function getThepages($spacing_id)
    {
        return self::find()->select(['name', 'id'])->where(['space_id'=> $spacing_id])->indexBy('id')->orderBy('id ASC')->column();
    }

    public static function getPages()
    {
        return self::find()->select(['name','id'])->indexBy('id')->orderBy('id ASC')->column();
    }

    public static function getSpacingList($spacing_id)
    {
        $subCategories = self::find()->select(['id','name'])
            ->where(['space_id'=> $spacing_id])
            ->asArray()
            ->all();

        return $subCategories;
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSpace()
    {
        return $this->hasOne(Spacing::className(), ['id' => 'space_id']);
    }

    /**
     * @inheritdoc
     * @return PagesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PagesQuery(get_called_class());
    }
}
