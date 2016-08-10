<?php

namespace PortfolioSelector\Provider\Test;


use PortfolioSelector\Provider\Combination;

class CombinationTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     */
    public function get_all_possible_combinations()
    {
        $combinations = Combination::create(2, 5);
        
        $this->assertEquals(21, count($combinations));
    }

  
}


