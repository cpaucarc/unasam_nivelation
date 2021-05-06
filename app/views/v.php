<?php
$num = 74;
$porcentaje = 0;
for ($i = 1; $i <= $num; $i++) {
    $porcentaje = round(($i / $num) * 100, 1);
    echo $porcentaje . '-';
}