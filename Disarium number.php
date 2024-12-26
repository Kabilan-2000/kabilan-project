<?php
$num = 175;
$sum = 0;
$digits = str_split($num);
for ($i = 0; $i < count($digits); $i++) {
    $sum += pow($digits[$i], $i + 1);
}
echo ($sum == $num) ? "$num is a Disarium number." : "$num is not a Disarium number.";
?>
