<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Users]].
 *
 * @see Users
 */
class UsersQuery extends \yii\db\ActiveQuery
{
	public function byPk($id)
	{
		$this
				->andWhere('id=:userId')
				->addParams([':userId' => $id]);
		return $this;
	}

	/**
	 * @inheritdoc
	 * @return Users[]|array
	 */
	public function all($db = null)
	{
		return parent::all($db);
	}

	/**
	 * @inheritdoc
	 * @return Users|array|null
	 */
	public function one($db = null)
	{
		return parent::one($db);
	}
}