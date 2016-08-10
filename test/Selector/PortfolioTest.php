<?php

namespace PortfolioSelector\Test;

use PortfolioSelector\Portfolio;
use PortfolioSelector\Stock;

class PortfolioTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     */
    public function can_create_new_portfolio()
    {
        $portfolio = new Portfolio();
        
        $this->assertInstanceOf(Portfolio::class, $portfolio);
    }

    /**
     * @test
     */
    public function can_add_stock_to_portfolio()
    {
        $portfolio = new Portfolio();
        
        $apple = new Stock('apple');
        
        $google = new Stock('google');
        
        $portfolio->add($apple);
        
        $portfolio->add($google);
        
        $this->assertCount(2, $portfolio->stocks());
    }

    /**
     * @test
     */
    public function get_expectation_value_of_portfolio()
    {
        $portfolio = new Portfolio();
        
        $apple = new Stock('Apple');

        $apple->setPerformances([3, 3, 3, 3]);

        $google = new Stock('Google');

        $google->setPerformances([6, 6, 6, 6]);

        $portfolio->add($apple);

        $portfolio->add($google);

        $this->assertEquals(0.045, $portfolio->expectation());
    }

    /**
     * @test
     */
    public function get_variance_of_portfolio()
    {
        $portfolio = new Portfolio();

        $apple = new Stock('Apple');

        $apple->setPerformances([0, 3, 0, 3]);

        $google = new Stock('Google');

        $google->setPerformances([0, 3, 0, 3]);

        $portfolio->add($apple);

        $portfolio->add($google);

        $this->assertEquals(0.015, $portfolio->variance());
    }
}


