<?php
$number = 121; 
$reversed = strrev((string)$number); 

if ($number == $reversed) {
    echo "$number is a palindrome.";
} else {
    echo "$number is not a palindrome.";
}
?>
