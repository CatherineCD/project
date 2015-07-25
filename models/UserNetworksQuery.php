<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[UserNetworks]].
 *
 * @see UserNetworks
 */
class UserNetworksQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return UserNetworks[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return UserNetworks|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}