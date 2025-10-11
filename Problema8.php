<?php
require_once 'Estaciones.php';
require_once 'Navegacion.php';
require_once 'validaciones.php'; // Incluir validaciones
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
        <p>🌍 Calculadora de Estación del Año</p>

        <form method="POST">
            <label>Seleccione una fecha:</label>
            <input type="date" name="fecha" required>
            <button type="submit">Determinar Estación</button>
        </form>

<?php
// Procesar cuando se envía el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fecha = $_POST['fecha'] ?? ''; // Formato: YYYY-MM-DD
    
    // Validar la fecha ingresada
    if (validarFecha($fecha)) {
        $partesFecha = explode('-', $fecha);
        $año = intval($partesFecha[0]);
        $mes = intval($partesFecha[1]);
        $dia = intval($partesFecha[2]);
        
        // Llamar función estática para obtener la estación
        $estacion = Estaciones::obtenerEstacion($mes, $dia);
        
        // Nombres de los meses en español
        $nombresMeses = [
            1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril',
            5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
            9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
        ];
        
        // Mostrar resultado
        echo '<div class="container">
                <h2>🌍 Resultado</h2>
                <div class="resultado-item">
                    <span>Fecha ingresada:</span>
                    <span>' . $dia . ' de ' . $nombresMeses[$mes] . ' de ' . $año . '</span>
                </div>
                <div class="resultado-item destacado">
                    <span>Estación del Año:</span>
                    <span><strong>' . sanitizarTexto($estacion) . '</strong></span>
                </div>
              </div>';
    } else {
        // Mostrar error si la fecha no es válida
        echo '<div>
                <strong>❌ Error:</strong> La fecha ingresada no es válida.
              </div>';
    }
}

// Navegación para volver al menú
Navegacion::volverAlMenu();
?>
</div>
    <?php include 'footer.php'; ?>
</body>
</html>