<?php
function checkDigits($number) {
    $numberStr = strval($number);
    
    for ($i = 0; $i < strlen($numberStr); $i++) {
        $digit = $numberStr[$i];
        
        if ($digit % 2 == 0) {
            echo "Digit $digit is even.<br>";
        } else {
            echo "Digit $digit is odd.<br>";
        }
    }
}
$number = 123456;
checkDigits($number);
?>
