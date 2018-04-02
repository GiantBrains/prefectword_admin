<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Paypal]].
 *
 * @see Paypal
 */
class PaypalQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Paypal[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Paypal|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
