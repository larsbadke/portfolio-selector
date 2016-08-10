<?php

namespace PortfolioSelector;

use PortfolioSelector\Provider\Covariance;

class Portfolio {

    
    protected $stocks = [];

    /**
     * Get all stocks in portfolio
     *
     * @return array
     */
    public function stocks()
    {
        return $this->stocks;
    }

    /**
     * Add stock to portfolio
     *
     * @param $stock
     */
    public function add($stock)
    {
        array_push($this->stocks, $stock);

        $percentage = 100 / count($this->stocks());

        foreach ($this->stocks() as $stock){

            $stock->setStake($percentage / 100);
        }
    }

    /**
     * Get expectation value of portfolio
     *
     * @return int
     */
    public function expectation()
    {
        $value = 0;

        foreach ($this->stocks() as $stock) {

            $value += $stock->getStake() * $stock->getExpectation();
        }

        return $value;
    }

    /**
     * Get variance of portfolio
     *
     * @return int
     */
    public function variance()
    {
        $varianceTerm = 0;

        foreach ($this->stocks() as $stock) {

            $varianceTerm += pow($stock->getStake() * $stock->getVariance(), 2);
        }
        
        $covarianceTerm = $this->covarianceTerm();

        return sqrt($varianceTerm + $covarianceTerm);
    }

    /**
     * Calculate covariance value
     *
     * @return number
     */
    protected function covarianceTerm()
    {
        $sum = [];

        foreach ($this->getPossibleStockCombinations() as $stockPair) {
            
            $covariance = Covariance::get($stockPair[0]->getPerformances(), $stockPair[1]->getPerformances());

            $sum[] = 2 * $covariance * $stockPair[0]->getStake() * $stockPair[1]->getStake();
        }

        return array_sum($sum);
    }

    /**
     * Get all possible covariance combinations
     *
     * @return array
     */
    protected function getPossibleStockCombinations()
    {
        $stocksPairs = [];

        foreach (range(2, 2) as $n) {
            
            foreach ($this->calculateCombinations($n, $this->stocks()) as $c) {
                
                $stocksPairs[] = $c;
            }
        }

        return $stocksPairs;
    }

    /**
     * Calculate combinations
     *
     * @param $m
     * @param $a
     * @return \Generator|void
     */
    protected function calculateCombinations($m, $a)
    {
        if (!$m) {
            yield [];
            return;
        }
        if (!$a) {
            return;
        }
        $h = $a[0];
        $t = array_slice($a, 1);
        foreach ($this->calculateCombinations($m - 1, $t) as $c)
            yield array_merge([$h], $c);
        foreach ($this->calculateCombinations($m, $t) as $c)
            yield $c;
    }

}