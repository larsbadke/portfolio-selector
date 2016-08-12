<?php

namespace PortfolioSelector\Test;

use PortfolioSelector\Portfolio;
use PortfolioSelector\Selector;
use PortfolioSelector\Stock;

class SelectorTest extends \PHPUnit_Framework_TestCase
{
    
    protected $portfolio;
    
    public function setUp()
    {
        parent::setUp();

        $this->portfolio = new Portfolio();
    }

    /**
     * @test
     */
    public function run_selection()
    {
        $apple = new Stock('apple');

        $google = new Stock('google');

        $apple->setPerformances([3, 3, 3, 3]);

        $google->setPerformances([6, 6, 6, 6]);

        $this->portfolio->add($apple);

        $this->portfolio->add($google);
        
        $selector = new Selector($this->portfolio);
        
        $selector->run();
        
        $this->assertEquals(21, count($selector->results()));
    }

    /**
     * @test
     */
    public function set_allocation_interval()
    {
        $apple = new Stock('apple');

        $google = new Stock('google');

        $apple->setPerformances([3, 3, 3, 3]);

        $google->setPerformances([6, 6, 6, 6]);

        $this->portfolio->add($apple);

        $this->portfolio->add($google);
        
        $selector = new Selector($this->portfolio);
        
        $selector->setInterval(10);

        $selector->run();

        $this->assertEquals(11, count($selector->results()));
    }
    
    /**
     * @test
     */
    public function get_lowest_risk_allocation()
    {
        $apple = new Stock('apple');

        $google = new Stock('google');

        $apple->setPerformances([0, 3, 0, 3]);

        $google->setPerformances([6, 0, 6, 0]);

        $this->portfolio->add($apple);

        $this->portfolio->add($google);

        $selector = new Selector($this->portfolio);

        $selector->setInterval(10);

        $selector->run();
        
        $lowestRisk = $selector->lowestRisk();

        $this->assertEquals(0.0015, $lowestRisk['variance']);
    }
}


