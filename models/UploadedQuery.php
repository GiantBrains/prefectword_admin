<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Uploaded]].
 *
 * @see Uploaded
 */
class UploadedQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Uploaded[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Uploaded|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
