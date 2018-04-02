<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Reject]].
 *
 * @see Reject
 */
class RejectQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Reject[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Reject|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
