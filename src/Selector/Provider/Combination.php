<?php

namespace PortfolioSelector\Provider;


class Combination {

    public static function create($stocks, $steps)
    {
        $data = [];

        for($i=0; $i<$stocks; $i++){

            array_push($data, self::steps($steps));
        }
        
        return self::combinations($data);
    }

    protected static function combinations(array $data, array &$all = array(), array $group = array(), $value = null, $i = 0)
    {
        $keys = array_keys($data);
        if (isset($value) === true) {
            array_push($group, $value);
        }

        if ($i >= count($data)) {

            if(array_sum($group) == 100){
                array_push($all, $group);
            }

        } else {
            $currentKey     = $keys[$i];
            $currentElement = $data[$currentKey];
            foreach ($currentElement as $val) {
                self::combinations($data, $all, $group, $val, $i + 1);
            }
        }

        return $all;
    }
    
    protected static function steps($steps)
    {
        $stepsArray = [];

        for ($i=0; $i<=100; $i=$i+$steps){

            $stepsArray[] = $i;
        }

        return $stepsArray;
    }
    
}
