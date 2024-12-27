<?php
$limit = 100;
echo "Pronic numbers between 1 and $limit are: ";
for ($i = 0; $i * ($i + 1) <= $limit; $i++) {
    echo $i * ($i + 1) . " ";
}
?>
