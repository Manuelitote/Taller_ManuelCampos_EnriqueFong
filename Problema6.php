<?php
require_once 'Operaciones.php';
require_once 'Navegacion.php';
require_once 'validaciones.php'; // Incluir archivo de validaciones
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
    // Validar y sanitizar la entrada
    $presupuestoInput = $_POST['presupuesto'] ?? '';
    $presupuestoTotal = procesarEntradaPresupuesto($presupuestoInput);
    
    if ($presupuestoTotal !== false) {
        // Llama la funcion estática de la clase externa
        $distribucion = Operaciones::calcularDistribucion($presupuestoTotal);

        if ($distribucion) { // Imprime la tabla con los resultados
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
            $datos = []; // Recorre con foreach cada resultado de la distribución
            foreach ($distribucion as $item) {
                // Sanitizar salida para prevenir XSS
                $area = htmlspecialchars($item["area"], ENT_QUOTES, 'UTF-8');
                $porcentaje = htmlspecialchars($item["porcentaje"], ENT_QUOTES, 'UTF-8');
                $presupuesto = number_format($item["presupuesto"], 2);
                
                $etiquetas[] = $area;
                $datos[] = $item["presupuesto"];
                echo '<tr>
                        <td>' . $area . '</td>
                        <td>' . $porcentaje . '%</td>
                        <td>$' . $presupuesto . '</td>
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
                    <strong>❌ Error:</strong> Error al calcular la distribución.
                </div>';
        }
    } else {
        echo '<div>
                <strong>❌ Error:</strong> Ingrese un presupuesto válido mayor a 0. 
                <br><small>Formato aceptado: números positivos con máximo 2 decimales (ej: 500000 o 500000.50)</small>
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