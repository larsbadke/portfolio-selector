<?php

namespace PortfolioSelector\Test;

use PortfolioSelector\Portfolio;
use PortfolioSelector\Stock;

class StockTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     */
    public function create_a_new_stock()
    {
        $apple = new Stock('Apple');
        
        $this->assertInstanceOf(Stock::class, $apple);
    }

    /**
     * @test
     */
    public function give_stock_a_name()
    {
        $apple = new Stock('Apple');

        $this->assertEquals('Apple', $apple->name);
    }

    /**
     * @test
     */
    public function set_stock_performances_in_percent()
    {
        $apple = new Stock('Apple');

        $apple->setPerformances([3, 3, 3, 3]);

        $this->assertEquals(0.03, $apple->getExpectation());
    }

    /**
     * @test
     */
    public function set_stock_performances_in_decimal()
    {
        $apple = new Stock('Apple');

        $apple->setPerformances([0.03, 0.03, 0.03, 0.03], false);

        $this->assertEquals(0.03, $apple->getExpectation());
    }

    /**
     * @test
     */
    public function get_stock_performances_in_decimal()
    {
        $apple = new Stock('Apple');

        $apple->setPerformances([0.03, 0.03, 0.03, 0.03], false);

        $this->assertTrue(is_array($apple->getPerformances()));

        $this->assertCount(4, $apple->getPerformances());
    }

    /**
     * @test
     */
    public function get_stock_expectation_value()
    {
        $apple = new Stock('Apple');

        $apple->setPerformances([3, 6, 3, 6]);

        $this->assertEquals(0.045, $apple->getExpectation());
    }

    /**
     * @test
     */
    public function get_stock_variance()
    {
        $apple = new Stock('Apple');

        $apple->setPerformances([3, 0, 3, 0]);

        $this->assertEquals(0.015, $apple->getExpectation());
    }

    /**
     * @test
     */
    public function set_and_get_stock_stake_in_portfolio()
    {
        $apple = new Stock('Apple');

        $apple->setPerformances([3, 0, 3, 0]);
        
        $apple->setStake(0.5);

        $this->assertEquals(0.5, $apple->getStake());
    }
}


