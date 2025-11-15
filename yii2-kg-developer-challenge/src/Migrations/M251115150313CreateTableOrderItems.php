<?php

namespace KGorod\DeveloperChallenge\Migrations;

use yii\db\Migration;

/**
 * Class M251115150313CreateTableOrderItems
 */
class M251115150313CreateTableOrderItems extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('order_items', [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer()->notNull(),
            'quantity' => $this->integer()->notNull(),
            'unit_price' => $this->decimal(10, 2)->notNull(),
        ]);

        $this->createIndex('idx-order_items-order_id', 'order_items', 'order_id');
        $this->addForeignKey(
            'fk-order_items-order_id',
            'order_items',
            'order_id',
            'orders',
            'id',
            'CASCADE'
        );
    }
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('order_items');
    }
}
