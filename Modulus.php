<?php
function modulus($a, $b) {
    if ($b != 0) {
        return $a % $b;
    } else {
        return "Modulus by zero is not allowed.";
    }
}
echo modulus(7,8);
?>

