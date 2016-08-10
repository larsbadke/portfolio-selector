<?php

namespace PortfolioSelector\Provider;


class Variance {


    public static function get(array $performances)
    {
        $deviation = 0;

        foreach ($performances as $performance){

            $deviation += pow($performance - Expectation::get($performances), 2);
        }

        return sqrt($deviation / count($performances));
    }

}
