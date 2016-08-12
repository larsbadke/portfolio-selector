<?php

namespace PortfolioSelector;

use PortfolioSelector\Provider\Combination;

class Selector
{
    /**
     * @var Portfolio
     */
    protected $portfolio;

    /**
     * Allocation interval
     * 
     * @var int
     */
    protected $interval = 5;

    /**
     * Allocations
     * 
     * @var
     */
    protected $allocations;

    /**
     * Inject portfolio instance
     * 
     * Selector constructor.
     * @param Portfolio $portfolio
     */
    public function __construct(Portfolio $portfolio)
    {
        $this->portfolio = $portfolio;
    }

    /**
     * Run portfolio selection
     * 
     * @return $this
     */
    public function run()
    {
        $stocks = $this->portfolio->stocks();

        $combinations = Combination::create(count($stocks), $this->interval);

        foreach ($combinations as $combination) {

            for($i=0; $i<count($stocks); $i++){

                $stocks[$i]->setStake($combination[$i] / 100);
            }

            $this->set($stocks);
        }

        return $this;
    }

    /**
     * Set allocation interval
     * 
     * @param $interval
     */
    public function setInterval($interval)
    {
        $this->interval = $interval;
    }

    /**
     * Set single allocation
     * 
     * @param $stocks
     * @return array
     */
    protected function set($stocks)
    {
        $combination = [];

        foreach ($stocks as $stock){

            $combination[$stock->name]= $stock->stake;
        }
        
        return $this->allocations[] = [
            'expectation' => $this->portfolio->expectation(),
            'variance' => $this->portfolio->variance(),
            'allocation' => $combination,
        ];
    }

    /**
     * Get selection results
     * 
     * @return mixed
     */
    public function results()
    {
        return $this->allocations;
    }

    /**
     * Get allocation with lowest risk
     * 
     * @return mixed
     */
    public function lowestRisk()
    {
        $min = $this->allocations[0];
        
        foreach ($this->allocations as $allocation){
            
            $min = ($allocation['variance'] < $min['variance']) ? $allocation : $min;
        }
        
        return $min;
    }


}
