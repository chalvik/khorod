<?php

declare(strict_types=1);

namespace KGorod\DeveloperChallenge\Models;

use Yii;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "{{%order_items}}".
 *
 * @property int $id
 * @property int $order_id
 * @property int $quantity
 * @property float $unit_price
 */
class OrderItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%order_items}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_id', 'quantity', 'unit_price'], 'required'],
            [['order_id', 'quantity'], 'integer'],
            [['unit_price'], 'number'],
            [
                ['order_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Order::class,
                'targetAttribute' => ['order_id' => 'id']
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'Order ID',
            'quantity' => 'Quantity',
            'unit_price' => 'Unit Price',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \KGorod\DeveloperChallenge\Models\Queries\OrderItemQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \KGorod\DeveloperChallenge\Models\Queries\OrderItemQuery(get_called_class());
    }

    public function getOrder(): ActiveQuery
    {
        return $this->hasOne(Order::class, ['id' => 'order_id']);
    }
}
