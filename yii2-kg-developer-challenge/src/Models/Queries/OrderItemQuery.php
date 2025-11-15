<?php

declare(strict_types=1);

namespace KGorod\DeveloperChallenge\Models\Queries;

/**
 * This is the ActiveQuery class for [[\KGorod\DeveloperChallenge\Models\OrderItem]].
 *
 * @see \KGorod\DeveloperChallenge\Models\OrderItem
 */
class OrderItemQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \KGorod\DeveloperChallenge\Models\OrderItem[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \KGorod\DeveloperChallenge\Models\OrderItem|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
