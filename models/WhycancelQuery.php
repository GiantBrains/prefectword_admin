<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Whycancel]].
 *
 * @see Whycancel
 */
class WhycancelQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Whycancel[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Whycancel|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
