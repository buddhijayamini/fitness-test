  <?php
    function getWindowIds($noOfPeriods, $currentMonth)
    {
        $window = -1;

        for ($x = 0; $x <= 11; $x++) {
            $window = $x;
        }

        $window = ($currentMonth / $noOfPeriods) / 6;
        $window = round($window);

        return $window;
    }

    for ($m = 1; $m <= 12; $m++) {

        $noOfPeriods = 2;
        $currentMonth = $m;

        echo "<p>currentMont= $currentMonth : noOfPeriods = $noOfPeriods : window   =" . getWindowIds($noOfPeriods, $currentMonth) . " </p>";
    }
    ?>
