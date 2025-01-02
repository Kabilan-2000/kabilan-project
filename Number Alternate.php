<?php
$input =8;
for ($i = 8; $i >= 1; $i--) {
    if ($i % 2 == 0) {
        for ($j = 1; $j <= $i; $j++) {
            echo "*";
        }
    } else {
        for ($j = 1; $j <= $i; $j++) {
            echo $i;
        }
    }
    echo "<br>";
}
?>
