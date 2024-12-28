<?php

$x = 3; 
$start = 1;
$end = 100;

for ($i = $start; $i <= $end; $i++) {
    if ($i % $x === 0) {
        echo $i . " ";
    }
}

?>
