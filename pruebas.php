<?php

$start = strtotime("2021-05-21");
$end = strtotime("2021-05-21");
$datediff = $end - $start;

echo round($datediff / (60 * 60 * 24)) . '<br>';

echo "Star:" . $start . '<br>';
echo "End:" . $end . '<br>';
echo "Diiff:" . $datediff . '<br>';