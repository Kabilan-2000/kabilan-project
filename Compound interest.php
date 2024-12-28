<?php
$principal = 10000;
$rate = 5;
$time = 2;

$compoundInterest = $principal * pow(1 + $rate / 100, $time) - $principal;

echo $compoundInterest;
?>
