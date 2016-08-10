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

        $apple = new Stock('apple');

        $google = new Stock('google');

        $apple->setPerformances([3, 3, 3, 3]);

        $google->setPerformances([6, 6, 6, 6]);

        $this->portfolio->add($apple);

        $this->portfolio->add($google);
    }

    /**
     * @test
     */
    public function run_selection()
    {
        $selector = new Selector($this->portfolio);
        
        $selector->run();
        
        $this->assertEquals(21, count($selector->results()));
    }

    /**
     * @test
     */
    public function set_allocation_interval()
    {
        $selector = new Selector($this->portfolio);
        
        $selector->setInterval(10);

        $selector->run();

        $this->assertEquals(11, count($selector->results()));
    }
}


