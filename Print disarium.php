<?php
for ($i = 1; $i <= 100; $i++) {
    $sum = array_sum(array_map(fn($d, $p) => $d ** $p, str_split($i), range(1, strlen($i))));
    if ($sum == $i) echo "$i "; 
}
?>
