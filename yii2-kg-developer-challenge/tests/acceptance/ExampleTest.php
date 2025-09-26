<?php

use Codeception\Test\Unit;

/**
 * Пример приемочного теста
 *
 * @author ilya.vikharev
 */
class ExampleTest extends Unit
{
    /**
     * @var UnitTester
     */
    protected $tester;

    // ======================= TESTS =========================
    
    /**
     * Тест, который должен выполняться всегда
     * 
     * @return void
     */
    public function testShouldRun(): void
    {
        $this->assertTrue(true, 'Этот тест должен выполняться');
    }
}
