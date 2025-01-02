<?php
$input = 5;

for ($i = $input; $i >= 1; $i--) {
    for ($j = 1; $j <= $i; $j++) {
        echo ($j % 2 == 1) ? "*" : "@";
    }
    echo "<br>"; 
}
?>



