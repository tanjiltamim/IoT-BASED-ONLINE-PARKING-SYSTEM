<?php

$arrivalTime=(strtotime("10:30"))/60;
$departureTime=(strtotime("12:00"))/60;

$cost = (($departureTime-$arrivalTime)/60)*40;  //Cost=40/hr

$HourDif=floor(($departureTime-$arrivalTime)/60);
$minDif=fmod(($departureTime-$arrivalTime), 60);
echo 'Hour:'.$HourDif .'<br>';
echo 'Minutes:'.$minDif .'<br>';
echo 'Cost:'.$cost .'<br>';



$arrivalDate=(strtotime("2022-06-15"))/(60*60*24);
$departureDate=(strtotime("2022-06-17"))/(60*60*24);

$DateDif=($departureDate-$arrivalDate);
echo 'Day:'.$DateDif .'<br>';




$arrivalDate=(strtotime("2022-06-15"))/60;
$departureDate=(strtotime("2022-06-17"))/60;

$totalArrival=$arrivalTime+$arrivalDate;
$totalDeparture=$departureTime+$departureDate;

$totalDif=($totalDeparture-$totalArrival)/60;
$totalCost=$totalDif*40;

echo 'Total Hours:'.$totalDif .'<br>';
echo 'Total Cost:'.$totalCost .'<br>';


?>