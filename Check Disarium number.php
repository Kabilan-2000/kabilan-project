<?php
$num = 145;
$sum = 0;
foreach (str_split($num) as $i => $digit) {
    $sum += pow($digit, $i + 1);
}
echo ($sum == $num) ? "$num is a Disarium number." : "$num is not a Disarium number.";
?>
