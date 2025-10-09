<?php
// Validar que un número sea mayor o igual a cero
function validarNumeroNoNegativo($num) {
    return is_numeric($num) && $num >= 0;
}

// Validar que un número sea positivo (>0)
function validarNumeroPositivo($num) {
    return is_numeric($num) && $num > 0;
}
?>
