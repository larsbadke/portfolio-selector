<?php

namespace PortfolioSelector\Provider;


class Covariance {


    public static function get(array $performance1, array $performance2)
    {
        $performances = [
            $performance1,
            $performance2,
        ];

        $count = min( count($performances[0]), count($performances[1]));

        $covariance = 0;

        for($i=0; $i<$count; $i++){

            $covariance += $performances[0][$i] * $performances[1][$i];
        }



        $covariance = $covariance / $count;

        $covariance -= Expectation::get($performance1) * Expectation::get($performance2);

        return $covariance;
    }

}
