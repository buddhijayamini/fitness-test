<?php
    function getWindowIds($noOfPeriods, $currentMonth)
    {
        $window = -1;

        for ($x = 0; $x <= 11; $x++) {
            $window = $x;
        }

        $window = ($currentMonth / $noOfPeriods) * 12 - 1;
        $window = (int)($window);

        return $window;
    }

    for ($m = 1; $m <= 12; $m++) {

        $noOfPeriods = 12;
        $currentMonth = $m;

        echo "<p>currentMonth= $currentMonth : noOfPeriods = $noOfPeriods : window   =" . getWindowIds($noOfPeriods, $currentMonth) . " </p>";
    }
 ?>