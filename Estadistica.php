<?php

class Estadisticas
{ 
    public static function calcularMedia($numeros)
    {
        return array_sum($numeros) / count($numeros);
    }
    
    public static function calcularDesviacionEstandar($numeros)
    {
        $media = self::calcularMedia($numeros);
        $varianza = 0;
        
        foreach ($numeros as $numero) {
            $varianza += pow($numero - $media, 2);
        }
        
        $varianza = $varianza / count($numeros);
        return sqrt($varianza);
    }
    
    public static function obtenerMinimo($numeros)
    {
        return min($numeros);
    }
    
    public static function obtenerMaximo($numeros)
    {
        return max($numeros);
    }
    
    public static function clasificarPorEdad($edad)
    {
        if ($edad >= 0 && $edad <= 12) {
            return 'Niño';
        } elseif ($edad >= 13 && $edad <= 17) {
            return 'Adolescente';
        } elseif ($edad >= 18 && $edad <= 64) {
            return 'Adulto';
        } elseif ($edad >= 65) {
            return 'Adulto Mayor';
        }
        return 'Edad inválida';
    }
}