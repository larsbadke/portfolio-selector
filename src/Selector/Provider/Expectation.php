<?php

namespace PortfolioSelector\Provider;


class Expectation {


    public static function get(array $performances)
    {
        $n = count($performances);

        $sum = array_sum($performances);
       
        return $sum / $n;
    }


 

}
