<?php
function binaryToDecimal($binary) {
    return bindec($binary);  
}

$binary = "1011";
$decimal = binaryToDecimal($binary);

echo "Binary: $binary is equal to Decimal: $decimal";
?>
