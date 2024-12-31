<?php
function division($a, $b) {
    if ($b != 0) {
        return $a / $b;
    } else {
        return "Division by zero is not allowed.";
    }
}
echo division(6, 3); 
?>
