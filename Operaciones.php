<?php

class Operaciones
{
    public static function obtenerPotencias($base, $cantidad)
    {
        $potencias = [];
        for ($i = 1; $i <= $cantidad; $i++) {
            $potencias[] = [
                'exponente' => $i,
                'resultado' => pow($base, $i)
            ];
        }
        return $potencias;
    }

    public static function calcularDistribucion($presupuestoTotal)
    {
        if ($presupuestoTotal <= 0) {
            return null;
        }

        $distribucion = [
            "Ginecología"   => 40,
            "Traumatología" => 35,
            "Pediatría"     => 25
        ];

        $resultado = [];
        foreach ($distribucion as $area => $porcentaje) {
            $resultado[] = [
                "area"       => $area,
                "porcentaje"    => $porcentaje,
                "presupuesto"     => ($porcentaje / 100) * $presupuestoTotal
            ];
        }

        return $resultado;
    }

    // Problema 2
    public static function sumarHastaMil()
    {
        $suma = 0;
        for ($i = 1; $i <= 1000; $i++) {
            $suma += $i;
        }
        return $suma;
    }

    // Problema 3
    public static function obtenerMultiplosDeCuatro($n)
    {
        $multiplos = [];
        for ($i = 1; $i <= $n; $i++) {
            $multiplos[] = [
                'multiplo' => $i,
                'resultado' => 4 * $i
            ];
        }
        return $multiplos;
    }

    // Problema 4
    public static function sumarParesEImpares()
    {
        $sumaPares = 0;
        $sumaImpares = 0;

        for ($i = 1; $i <= 200; $i++) {
            if ($i % 2 == 0) {
                $sumaPares += $i;
            } else {
                $sumaImpares += $i;
            }
        }

    // Retorna ambos resultados 
        return [
            'pares' => $sumaPares,
            'impares' => $sumaImpares
        ];
    }
    // Función para procesar matriz de ventas (Problema 10)
    public static function procesarMatrizVentas($matrizVentas, $vendedores) {
        $resultado = [
            'matriz' => [],
            'totalesVendedores' => [0, 0, 0, 0],
            'totalGeneral' => 0,
            'nombresVendedores' => []
        ];
        
        // Preparar nombres cortos de vendedores
        for ($i = 1; $i <= 4; $i++) {
            $vendedor = $vendedores[$i];
            $nombreCorto = substr($vendedor['nombre'], 0, 1) . '. ' . $vendedor['apellido'];
            $resultado['nombresVendedores'][] = $nombreCorto;
        }
        
        // Procesar cada producto
        for ($producto = 0; $producto < 5; $producto++) {
            $fila = [
                'producto' => $producto + 1,
                'ventas' => [],
                'totalProducto' => 0
            ];
            
            // Procesar cada vendedor
            for ($vendedor = 0; $vendedor < 4; $vendedor++) {
                $valor = $matrizVentas[$producto][$vendedor];
                $fila['ventas'][] = $valor;
                $fila['totalProducto'] += $valor;
                $resultado['totalesVendedores'][$vendedor] += $valor;
                $resultado['totalGeneral'] += $valor;
            }
            
            $resultado['matriz'][] = $fila;
        }
        
        return $resultado;
    }
}
