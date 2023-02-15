<?php

namespace App\Services;

class DriverExpenseService
{
    public function calculateDriverExpenses(array $drivers, array $expenses)
    {
        $result = [];

        $numDrivers = count($drivers);
        $isFirstTurn = true;

        foreach ($expenses as $expense => $value) {
            // Multiply by 100 and round to 0 decimal places
            $intValue = intval(bcmul($value, 100, 0));
            $isExpenseDivisible = ($intValue % 2 === 0) ? true : false;

            if ($isExpenseDivisible) {
                $result[$drivers[0]][$expense] = $value / $numDrivers;
                $result[$drivers[1]][$expense] = $value / $numDrivers;
            } else {
                if ($isFirstTurn) {
                    $result[$drivers[0]][$expense] = ceil(($value * 100)/$numDrivers) / 100;
                    $result[$drivers[1]][$expense] = floor(($value * 100)/$numDrivers) / 100;
                } else {
                    $result[$drivers[0]][$expense] = Floor(($value * 100)/$numDrivers) / 100;
                    $result[$drivers[1]][$expense] = ceil(($value * 100)/$numDrivers) / 100;
                }
                $isFirstTurn = !$isFirstTurn;
            }

            //Used for debug to see if Total difference isn't greater than 0.01
            // if (!isset($result[$drivers[0]]['Total'])){
            //     $result[$drivers[0]]['Total'] = 0;
            //     $result[$drivers[1]]['Total'] = 0;
            //     asort($result[$drivers[0]]);
            //     asort($result[$drivers[1]]);
            // }
            //     $result[$drivers[0]]['Total'] += $result[$drivers[0]][$expense];
            //     $result[$drivers[1]]['Total'] += $result[$drivers[1]][$expense];
        }

        return $result;
    }
}
