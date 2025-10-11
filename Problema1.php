<?php
require_once 'Navegacion.php';
require_once 'validaciones.php';
require_once 'Estadistica.php'?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Problema 1</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
<div class="container">
<h2>Problema #1</h2>
<p>Calcular la media, desviación estándar, número mínimo y máximo de los 5 primeros números positivos introducidos.</p>

<!-- Formulario para ingresar 5 números positivos -->
<form method="post">
    <?php for($i=1; $i<=5; $i++): ?>
        <input type="number" name="num<?= $i ?>" placeholder="Número <?= $i ?>" min="0" required><br>
    <?php endfor; ?>
    <button type="submit" name="calcular">Calcular</button>
</form>

<?php
// Procesa los datos al enviar el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $numbers = [
        floatval($_POST['num1']),
        floatval($_POST['num2']),
        floatval($_POST['num3']),
        floatval($_POST['num4']),
        floatval($_POST['num5'])
    ];
    
    $allPositive = true;
    foreach ($numbers as $num) {
        if ($num <= 0) {
            $allPositive = false;
            break;
        }
    }
    
    if ($allPositive) {
        $media = Estadisticas::calcularMedia($numbers);
        $stdDev = Estadisticas::calcularDesviacionEstandar($numbers);
        $min = Estadisticas::obtenerMinimo($numbers);
        $max = Estadisticas::obtenerMaximo($numbers);
        
        echo '<div class="container">
                <h2>📊 Resultados</h2>
                <div class="stat">
                    <span class="stat-label">Media:</span>
                    <span class="stat-value">' . number_format($media, 2) . '</span>
                </div>
                <div class="stat">
                    <span class="stat-label">Desviación Estándar:</span>
                    <span class="stat-value">' . number_format($stdDev, 2) . '</span>
                </div>
                <div class="stat">
                    <span class="stat-label">Mínimo:</span>
                    <span class="stat-value">' . number_format($min, 2) . '</span>
                </div>
                <div class="stat">
                    <span class="stat-label">Máximo:</span>
                    <span class="stat-value">' . number_format($max, 2) . '</span>
                </div>
              </div>';
    } else {
        echo '<div style="background: #fff5f5; border-left: 4px solid #fc8181; padding: 20px; border-radius: 8px; margin: 20px 0;">
                <strong>❌ Error:</strong> Todos los números deben ser positivos.
              </div>';
    }
}
Navegacion::volverAlMenu();
?>
</div>
<?php include 'footer.php'; // Incluye el pie de página ?>
</body>
</html>
