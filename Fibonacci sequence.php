<?php
$n = 10; 
$a = 0;
$b = 1;
echo "Fibonacci sequence:\n";

for ($i = 0; $i < $n; $i++) {
    echo $a . " ";
    $next = $a + $b;
    $a = $b;
    $b = $next;
}
?>
