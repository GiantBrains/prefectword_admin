<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Spacing]].
 *
 * @see Spacing
 */
class SpacingQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Spacing[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Spacing|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
