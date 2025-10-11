<?php  
require_once __DIR__ . '/Navegacion.php';
require_once __DIR__ . '/validaciones.php'; 
require_once __DIR__ . '/Estadistica.php'; // Clase con el método clasificarEdades
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Problema 5</title>
    <link rel="stylesheet" href="estilo.css">
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
    $edades = [];

    // Leer edades del formulario
    for ($i=1; $i<=5; $i++) {
        $edad = $_POST["edad$i"];
        if (!validarNumeroNoNegativo($edad)) {
            echo "<p style='color:red;'>Edad inválida.</p>";
            exit;
        }
        $edades[] = $edad;
    }

    // 🔹 Usar la clase Estadisticas
    $resultado = Estadisticas::clasificarEdades($edades);
    $categorias = $resultado['categorias'];
    $repetidos = $resultado['repetidos'];

    // Mostrar resultados
    echo "<h3>Resultados:</h3>";
    foreach ($categorias as $tipo => $cantidad) {
        echo "$tipo: $cantidad<br>";
    }

    if (!empty($repetidos)) {
        echo "<br><strong>Nota:</strong> Hay edades repetidas.<br>";
        echo "<strong>Frecuencia de edades:</strong><br>";
        foreach ($repetidos as $edad => $cantidad) {
            echo "Edad $edad: $cantidad veces<br>";
        }
    }

    // Gráfica con Chart.js
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
<?php include __DIR__ . '/footer.php'; ?>
</body>
</html>
