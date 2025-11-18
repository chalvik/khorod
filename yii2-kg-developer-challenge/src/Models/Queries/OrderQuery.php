<?php

declare(strict_types=1);

namespace KGorod\DeveloperChallenge\Models\Queries;

/**
 * This is the ActiveQuery class for [[\KGorod\DeveloperChallenge\Models\Order]].
 *
 * @see \KGorod\DeveloperChallenge\Models\Order
 */
class OrderQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \KGorod\DeveloperChallenge\Models\Order[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \KGorod\DeveloperChallenge\Models\Order|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
