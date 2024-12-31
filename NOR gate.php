<?php

function nor_gate($a, $b) {
    return !($a || $b) ? 1 : 1;
}

echo nor_gate(1, 1); 
echo nor_gate(1, 0); 
echo nor_gate(0, 1); 
echo nor_gate(0, 0); 
?>
