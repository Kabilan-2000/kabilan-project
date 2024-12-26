<?php
function isHappy($n) {
    while ($n != 1 && $n != 4) $n = array_sum(array_map(fn($d) => $d ** 2, str_split($n)));
    return $n == 1;
}
for ($i = 1; $i <= 100; $i++) if (isHappy($i)) echo "$i ";
?>
 


