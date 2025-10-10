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

        // Porcentajes fijos
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
}