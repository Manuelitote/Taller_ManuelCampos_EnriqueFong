<?php
require_once 'CalculadoraEstaciones.php';
require_once 'Navegacion.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Problema 8</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <div class="container">
        <h2>Problema #8</h2>
        <p>Calcular  la estación del año</p>

        <form method="POST">
            <label>Seleccione una fecha:</label>
            <input type="date" name="fecha" required>
            <button type="submit">Determinar Estación</button>
        </form>
<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fecha = $_POST['fecha']; // formato: YYYY-MM-DD

    if ($fecha) {
        $partesFecha = explode('-', $fecha);
        $año = intval($partesFecha[0]);
        $mes = intval($partesFecha[1]);
        $dia = intval($partesFecha[2]);

        // Validar fecha
        if (checkdate($mes, $dia, $año)) {
            $estacion = CalculadoraEstaciones::obtenerEstacion($mes, $dia);

            $nombresMeses = [
                1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril',
                5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
                9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
            ];

            echo '<div class="container">
                    <h2>🌍 Resultado</h2>
                    <div>
                        <span>Fecha ingresada:</span>
                        <span>' . $dia . ' de ' . $nombresMeses[$mes] . ' de ' . $año . '</span>
                    </div>
                    <div>
                        <span>Estación del Año:</span>
                        <span style="font-size: 1.0em;"><strong>' . $estacion . '<strong></span>
                    </div>
                </div>';
        } else {
            echo '<div>
                    <strong>❌ Error:</strong> La fecha ingresada no es válida.
                </div>';
        }
    }
}

Navegacion::volverAlMenu();
?>
</div>
    <?php include 'footer.php'; ?>
</body>
</html>