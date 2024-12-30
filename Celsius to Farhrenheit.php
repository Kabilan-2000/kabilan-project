<?php
function celsiusToFahrenheit($celsius) {
    return ($celsius * 9/5) + 32;
}
$celsius = 25;
$fahrenheit = celsiusToFahrenheit($celsius);

echo $celsius . "°C is equal to " . $fahrenheit . "°F";
?>
