<?php

namespace KGorod\DeveloperChallenge\Migrations;

use yii\db\Migration;

/**
 * Class M251115150253CreateTableOrders
 */
class M251115150253CreateTableOrders extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('orders', [
            'id'         => $this->primaryKey(),
            'user_id'    => $this->integer()->notNull(),
            'total'      => $this->decimal(10,2)->notNull(),
            'created_at' => $this->integer()->notNull(),
        ]);

        $this->createIndex('idx-orders-user_id', 'orders', 'user_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('orders');
    }
}
