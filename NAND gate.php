<?php
function nand_gate($a, $b) {
    return !($a && $b) ? 1 : 0;
}
echo nand_gate(1, 1);
echo nand_gate(1, 0);
echo nand_gate(0, 1); 
echo nand_gate(0, 0); 
?>
