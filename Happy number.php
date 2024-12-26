<?php
function isHappy($num) {
    while ($num != 1 && $num != 4) {
        $num = array_sum(array_map(fn($d) => $d * $d, str_split($num)));
    }
    return $num == 1;
}
$num = 82;
echo isHappy($num) ? "$num is a Happy Number" : "$num is not a Happy Number";
?>

