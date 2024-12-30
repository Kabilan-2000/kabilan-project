<?php
$number = 12;

echo "The divisors of $number are:\n";
for ($i = 1; $i <= $number; $i++) {
    if ($number % $i == 0) {
        echo $i . " ";
    }
}
?>
