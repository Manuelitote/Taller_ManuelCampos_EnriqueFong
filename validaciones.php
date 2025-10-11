<?php
// Validar que un número sea mayor o igual a cero
function validarNumeroNoNegativo($num) {
    return is_numeric($num) && $num >= 0;
}

// Validar que un número sea positivo (>0)
function validarNumeroPositivo($num) {
    return is_numeric($num) && $num > 0;
}

// Validar presupuesto (número positivo con máximo 2 decimales)
function validarPresupuesto($presupuesto) {
    // Verificar que sea numérico y positivo
    if (!is_numeric($presupuesto) || $presupuesto <= 0) {
        return false;
    }
    
    // Verificar formato con preg_match (permite hasta 2 decimales)
    if (!preg_match('/^\d+(\.\d{1,2})?$/', (string)$presupuesto)) {
        return false;
    }
    
    // Validar rango razonable (opcional - máximo 1 billón)
    if ($presupuesto > 1000000000000) {
        return false;
    }
    
    return true;
}

// Sanitizar entrada numérica
function sanitizarNumero($input) {
    $input = trim($input);
    $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
    return $input;
}

// Sanitizar y validar entrada completa para presupuesto
function procesarEntradaPresupuesto($input) {
    $input = sanitizarNumero($input);
    
    if (validarPresupuesto($input)) {
        return floatval($input);
    }
    
    return false;
}

// Validar número entero en un rango específico
function validarEnteroEnRango($numero, $min, $max) {
    $numero = intval($numero);
    return ($numero >= $min && $numero <= $max);
}

// Validar número decimal positivo
function validarDecimalPositivo($numero, $maxDecimales = 2) {
    if (!is_numeric($numero) || $numero < 0) {
        return false;
    }
    
    // Validar formato decimal
    $patron = '/^\d+(\.\d{1,' . $maxDecimales . '})?$/';
    return preg_match($patron, (string)$numero);
}

// Validar nota (0-100 con hasta 2 decimales)
function validarNota($nota) {
    if (!is_numeric($nota)) {
        return false;
    }
    
    $nota = floatval($nota);
    return ($nota >= 0 && $nota <= 100 && validarDecimalPositivo($nota));
}

// Validar fecha en formato YYYY-MM-DD
function validarFecha($fecha) {
    if (empty($fecha)) {
        return false;
    }
    
    // Validar formato con preg_match
    if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $fecha)) {
        return false;
    }
    
    // Validar con checkdate
    $partes = explode('-', $fecha);
    if (count($partes) !== 3) {
        return false;
    }
    
    $año = intval($partes[0]);
    $mes = intval($partes[1]);
    $dia = intval($partes[2]);
    
    return checkdate($mes, $dia, $año);
}

// Sanitizar texto (prevenir XSS)
function sanitizarTexto($texto) {
    $texto = trim($texto);
    $texto = htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');
    return $texto;
}

// Validar nombre (solo letras, espacios y algunos caracteres especiales)
function validarNombre($nombre) {
    if (empty($nombre)) {
        return false;
    }
    
    // Permitir letras, espacios, acentos y ñ
    return preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s\-\']+$/', $nombre);
}

// Validar monto de venta (positivo con 2 decimales)
function validarMontoVenta($monto) {
    if (!is_numeric($monto) || $monto <= 0) {
        return false;
    }
    
    return preg_match('/^\d+(\.\d{1,2})?$/', (string)$monto);
}
?>