<?php 
require_once 'Navegacion.php';
require_once 'validaciones.php'; 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Problema 5</title>
    <link rel="stylesheet" href="estilo.css">
    <!-- Agregamos Chart.js para la gráfica -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<div class="container">
<h2>Problema #5</h2>
<p>Leer la edad de 5 personas y clasificarlas por categoría.</p>

<form method="post">
    <?php for ($i=1; $i<=5; $i++): ?>
        <input type="number" name="edad<?= $i ?>" placeholder="Edad <?= $i ?>" min="0" required><br>
    <?php endfor; ?>
    <button type="submit" name="procesar">Procesar</button>
</form>

<?php
if (isset($_POST['procesar'])) {
    $categorias = ["Niño" => 0, "Adolescente" => 0, "Adulto" => 0, "Adulto mayor" => 0];
    $edades = [];

    // Clasificación de edades
    for ($i=1; $i<=5; $i++) {
        $edad = $_POST["edad$i"];
        if (!validarNumeroNoNegativo($edad)) {
            echo "<p style='color:red;'>Edad inválida.</p>";
            exit;
        }
        $edades[] = $edad;

        if ($edad <= 12) $categorias["Niño"]++;
        elseif ($edad <= 17) $categorias["Adolescente"]++;
        elseif ($edad <= 64) $categorias["Adulto"]++;
        else $categorias["Adulto mayor"]++;
    }

    // Muestra resultados por categoría
    echo "<h3>Resultados:</h3>";
    foreach ($categorias as $tipo => $cantidad) {
        echo "$tipo: $cantidad<br>";
    }

    // Verifica si hay edades repetidas
    if (count($edades) !== count(array_unique($edades))) {
        echo "<br><strong>Nota:</strong> Hay edades repetidas.<br>";

        // Estadísticas adicionales si hay repetidos
        $repetidos = array_count_values($edades);
        echo "<strong>Frecuencia de edades:</strong><br>";
        foreach ($repetidos as $edad => $cantidad) {
            if ($cantidad > 1) {
                echo "Edad $edad: $cantidad veces<br>";
            }
        }
    }

    // Generar gráfica con Chart.js
    $categorias_json = json_encode(array_keys($categorias));
    $valores_json = json_encode(array_values($categorias));
    echo '<canvas id="graficaEdades" width="400" height="200"></canvas>';
    echo "
    <script>
    const ctx = document.getElementById('graficaEdades').getContext('2d');
    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: $categorias_json,
            datasets: [{
                label: 'Cantidad de personas',
                data: $valores_json,
                backgroundColor: ['#FF6384','#36A2EB','#FFCE56','#4BC0C0']
            }]
        },
        options: {
            scales: {
                y: { beginAtZero: true, precision:0 }
            }
        }
    });
    </script>
    ";
}
Navegacion::volverAlMenu();
?>
</div>
<?php include 'footer.php'; ?>
</body>
</html>
