<?php
$number = 123456; 
$digits = str_split($number);

foreach ($digits as $digit) {
    if ($digit % 2 != 0) {
        echo $digit . " ";
    }
}
?>
