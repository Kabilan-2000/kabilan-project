<?php
$fruits = ["Apple", "Banana", "Cherry", "Date"];

$removedFruit = array_shift($fruits);

echo "Removed Fruit: $removedFruit\n"; 
echo "Updated Array: " . implode(", ", $fruits) . "\n"; 
?>
