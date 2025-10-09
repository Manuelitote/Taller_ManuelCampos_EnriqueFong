<?php
class CalculadoraEstaciones
{ 
    public static function obtenerEstacion($mes, $dia)
    {
        if (($mes == 12 && $dia >= 21) || ($mes >= 1 && $mes <= 2) || ($mes == 3 && $dia < 21)) {
            return '☀️ Verano';
        } elseif (($mes == 3 && $dia >= 21) || ($mes >= 4 && $mes <= 5) || ($mes == 6 && $dia <= 21)) {
            return '🍂 Otoño';
        } elseif (($mes == 6 && $dia >= 22) || ($mes >= 7 && $mes <= 8) || ($mes == 9 && $dia <= 22)) {
            return '❄️ Invierno';
        } else {
            return '🌸 Primavera';
        }
    }
}