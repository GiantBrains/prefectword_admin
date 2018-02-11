<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Urgency]].
 *
 * @see Urgency
 */
class UrgencyQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Urgency[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Urgency|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
