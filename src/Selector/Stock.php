<?php

namespace PortfolioSelector;

use PortfolioSelector\Provider\Expectation;
use PortfolioSelector\Provider\Variance;

class Stock {

    /**
     * Stock name
     *
     * @var
     */
    public $name;

    /**
     * Stake
     *
     * @var
     */
    public $stake;

    /**
     * Expectation value
     *
     * @var
     */
    protected $expectation;

    /**
     * Variance
     *
     * @var
     */
    protected $variance;

    /**
     * Performances
     *
     * @var array
     */
    protected $performances = [];

    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * Set stock performances
     *
     * @param array $performances
     * @param bool $percentage
     * @return array
     */
    public function setPerformances(array $performances, $percentage = true)
    {
        if($percentage){

            foreach ($performances as $performance){

                array_push($this->performances, $performance / 100);
            }

            return $this->performances;
        }

        return $this->performances = $performances;
    }

    /**
     * Get stock performances
     * 
     * @return mixed
     */
    public function getPerformances()
    {
        return $this->performances;
    }

    /**
     * Get expectation value of stock
     * 
     * @return float
     */
    public function getExpectation()
    {
        return $this->expectation = Expectation::get($this->performances);
    }
    
    /**
     * Get variance of stock
     *
     * @return float
     */
    public function getVariance()
    {
        return $this->variance = Variance::get($this->performances);
    }

    /**
     * Set percentage
     * 
     * @param $stake
     */
    public function setStake($stake)
    {
        $this->stake = $stake;
    }

    /**
     * Get percentage
     * 
     * @return mixed
     */
    public function getStake()
    {
        return $this->stake;
    }
    
}
