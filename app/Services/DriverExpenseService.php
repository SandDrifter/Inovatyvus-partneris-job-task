<?php
 
namespace App\Services;
  
class DriverExpenseService
{
    public function calculateDriverExpenses(array $drivers, array $expenses)
    {
        $result = [];

        // Write your logic here.
        // ...
        $numDrivers = count($drivers);
       for ($i=0; $i < $numDrivers; $i++) {
            $isFirstDriver = ($i == 0) ? True : False;
            $driver = $drivers[$i];

            foreach ($expenses as $expense => $value) {
                if($isFirstDriver){
                    $result[$driver][$expense] = ceil( ($value * 100)/$numDrivers ) / 100;
                }else{
                    $result[$driver][$expense] = floor( ($value * 100)/$numDrivers ) / 100;
                }
            }
       }

        return $result;
    }
}
