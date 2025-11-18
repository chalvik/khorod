<?php

use KGorod\DeveloperChallenge\PublicApi\DeveloperChallengeApi;
use Yii;

class DeveloperChallengeApiFunctionalCest
{
    public function _before()
    {
        // Выполняем миграции пакета
        Yii::$app->runAction('migrate/up', ['interactive' => true]);

        // Чистим таблицы
        Yii::$app->db->createCommand()->delete('order_items')->execute();
        Yii::$app->db->createCommand()->delete('orders')->execute();

//         Заполняем тестовыми данными
        Yii::$app->db->createCommand()->batchInsert('orders',
            ['id', 'user_id', 'created_at', 'total'],
            [
                [1, 10, 23455, 150.00],
                [2, 10, 232323, 200.00],
            ]
        )->execute();

        Yii::$app->db->createCommand()->batchInsert('order_items',
            ['id', 'order_id', 'quantity', 'unit_price'],
            [
                [1, 1, 2, 20.00],   //40
                [2, 1, 5, 10.00],   //50
                [3, 2, 4, 25.00],   //100
                [4, 2, 2, 50.00],   //100
            ]
        )->execute();
    }

    // ----------------------------------------------------------------------
    // TEST #1: getOrderSummary
    // ----------------------------------------------------------------------
    public function testGetOrderSummary(FunctionalTester $tester)
    {
        /** @var DeveloperChallengeApi $api */
        $api = Yii::$container->get(DeveloperChallengeApi::class);
//
        $result = $api->getOrderSummary(1);

        $tester->assertEquals(10, $result['user_id']);
        $tester->assertEquals(23455, $result['created_at']);
        $tester->assertEquals(90.00, $result['total_from_items']);  // 40 + 50
        $tester->assertEquals(150.00, $result['total_from_orders']);
        $tester->assertEquals(2, $result['items_count']);
        $tester->assertEquals(60.00, $result['price_diff']);
    }

    // ----------------------------------------------------------------------
    // TEST #2: listOrdersByUser
    // ----------------------------------------------------------------------
    public function testListOrdersByUser(FunctionalTester $tester)
    {
        /** @var DeveloperChallengeApi $api */
        $api = Yii::$container->get(DeveloperChallengeApi::class);

        $orders = $api->listOrdersByUser(10);



        $tester->assertEquals(2, count($orders));
        $tester->assertEquals(1, $orders[0]['order_id']);
        $tester->assertEquals(150.00, $orders[0]['total_from_orders']);
        $tester->assertEquals(2, $orders[0]['items_count']);

        $tester->assertEquals(2, $orders[1]['order_id']);
        $tester->assertEquals(200.00, $orders[1]['total_from_orders']);
        $tester->assertEquals(2, $orders[1]['items_count']);
    }

    // ----------------------------------------------------------------------
    // TEST #3: calculateOrderTaxes
    // ----------------------------------------------------------------------
    public function testCalculateOrderTaxes(FunctionalTester $tester)
    {
        /** @var DeveloperChallengeApi $api */
        $api = Yii::$container->get(DeveloperChallengeApi::class);

        $result = $api->calculateOrderTaxes(2, 0.15); //15%

//         subtotal = 200
//         tax = 30
//         total = 230

        $tester->assertEquals(2, $result['order_id']);
        $tester->assertEquals(200.00, $result['subtotal']);
        $tester->assertEquals(0.15, $result['tax_rate']);
        $tester->assertEquals(30.00, $result['tax_amount']);
        $tester->assertEquals(230.00, $result['total_with_tax']);
    }

    // ----------------------------------------------------------------------
    // TEST #4: test via strict DI validation
    // ----------------------------------------------------------------------
    public function testApiIsResolvedFromDi(FunctionalTester $tester)
    {
        $api = Yii::$container->get(DeveloperChallengeApi::class);
        $tester->assertInstanceOf(DeveloperChallengeApi::class, $api);
    }
}
