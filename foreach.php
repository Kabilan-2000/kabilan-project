<?php
$mixedArray = [
    "Apple",
    "Banana",
    "Cherry",
    "fruit" => "Date",  
    "grape" => "Purple"
];

foreach ($mixedArray as $key => $value) {
    if (is_int($key)) {
        
        echo "Fruit: $value<br>";
    } else {
    
        echo "The key is $key and the value is $value.<br>";
    }
}
?>
