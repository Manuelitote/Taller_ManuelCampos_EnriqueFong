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
    
    // Problema 5
    public static function clasificarEdades(array $edades)
    {
        $categorias = ["Niño" => 0, "Adolescente" => 0, "Adulto" => 0, "Adulto Mayor" => 0];

        foreach ($edades as $edad) {
            switch (true) {
                case ($edad >= 0 && $edad <= 12):
                    $categorias["Niño"]++;
                    break;
                case ($edad >= 13 && $edad <= 17):
                    $categorias["Adolescente"]++;
                    break;
                case ($edad >= 18 && $edad <= 64):
                    $categorias["Adulto"]++;
                    break;
                case ($edad >= 65):
                    $categorias["Adulto Mayor"]++;
                    break;
            }
        }

        // Repetidos
        $repetidos = array_count_values($edades);
        foreach ($repetidos as $edad => $cantidad) {
            if ($cantidad <= 1) {
                unset($repetidos[$edad]);
            }
        }

        return [
            'categorias' => $categorias,
            'repetidos' => $repetidos
        ];
    }
}
