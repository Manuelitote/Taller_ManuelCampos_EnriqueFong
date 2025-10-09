<?php
require_once 'OperacionesMatematicas.php';
require_once 'Navegacion.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Problema 6</title>
    <link rel="stylesheet" href="estilo.css">
    <!-- Agregamos Chart.js para la gráfica -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<div class="container">
<h2>Problema #6</h2>
<p>Calcular presupuesto del hospital</p>

<form method="POST">
    <label>Presupuesto Total Anual ($):</label>
    <input type="number" step="0.01" name="presupuesto" required placeholder="Ej: 500000">
    
    <button type="submit">Calcular Distribución</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $presupuestoTotal = floatval($_POST['presupuesto']);

    $distribucion = OperacionesMatematicas::calcularDistribucion($presupuestoTotal);

    if ($distribucion) {
        echo '<div>
                <h2>Distribución del Presupuesto</h2>
                <p><strong>Presupuesto Total: $' . number_format($presupuestoTotal, 2) . '</strong></p>
                <table>
                    <tr>
                        <th>Área</th>
                        <th>Porcentaje</th>
                        <th>Presupuesto</th>
                    </tr>';

        $etiquetas = [];
        $datos = [];
        foreach ($distribucion as $item) {
            $etiquetas[] = $item["area"];
            $datos[] = $item["presupuesto"];
            echo '<tr>
                    <td>' . $item["area"] . '</td>
                    <td>' . $item["porcentaje"] . '%</td>
                    <td>$' . number_format($item["presupuesto"], 2) . '</td>
                </tr>';
        }

        echo '  </table>
            </div>';

        // === Gráfico de pastel con Chart.js ===
        echo '<div style="text-align: center; margin: 30px 0;">
                <canvas id="graficoPresupuesto" width="400" height="400"></canvas>
            </div>';
        echo "<script>
                const contexto = document.getElementById('graficoPresupuesto').getContext('2d');
                new Chart(contexto, {
                    type: 'pie',
                    data: {
                        labels: " . json_encode($etiquetas) . ",
                        datasets: [{
                            label: 'Distribución del Presupuesto',
                            data: " . json_encode($datos) . ",
                            backgroundColor: ['#FF6B6B','#4ECDC4','#45B7D1']
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }
                });
            </script>";
    } else {
        echo '<div>
                <strong>❌ Error:</strong> Ingrese un presupuesto válido mayor a 0.
            </div>';
    }
}
?>


<?php
Navegacion::volverAlMenu();
?>
</div>
<?php include 'footer.php'; ?>
</body>
</html>