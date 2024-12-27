<?php
$num = 156;
$sum = array_sum(str_split($num));
echo ($num % $sum == 0) ? "$num is a Harshad number" : "$num is not a Harshad number";
?>







