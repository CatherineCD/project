<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[QuestionAnswer]].
 *
 * @see QuestionAnswer
 */
class QuestionAnswerQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return QuestionAnswer[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return QuestionAnswer|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}