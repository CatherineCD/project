<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Networks]].
 *
 * @see Networks
 */
class NetworksQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Networks[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Networks|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}