<?php

declare(strict_types=1);

namespace KGorod\DeveloperChallenge\Models;

use Yii;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "{{%orders}}".
 *
 * @property int $id
 * @property int $user_id
 * @property float $total
 * @property int $created_at
 */
class Order extends \yii\db\ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%orders}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'total', 'created_at'], 'required'],
            [['user_id', 'created_at'], 'integer'],
            [['total'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'total' => 'Total',
            'created_at' => 'Created At',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \KGorod\DeveloperChallenge\Models\Queries\OrderQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \KGorod\DeveloperChallenge\Models\Queries\OrderQuery(get_called_class());
    }

    function orderItems(): ActiveQuery
    {
        return $this->hasMany(OrderItem::class, ['order_id' => 'id']);
    }
}
