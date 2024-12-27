<?php
$a = 5;
$b = 10;

echo "Before swapping: a = $a, b = $b\n";
[$a, $b] = [$b, $a]; 
echo "After swapping: a = $a, b = $b";
?>
