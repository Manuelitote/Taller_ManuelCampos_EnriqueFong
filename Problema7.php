<?php
require_once 'Estadistica.php';
require_once 'Navegacion.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Problema 7</title>
    <link rel="stylesheet" href="estilo.css">
    <!-- Agregamos Chart.js para la gráfica -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container">
        <h2>Problema #7</h2>
        <form method="POST">
            <label>¿Cuántas notas desea ingresar?</label>
            <input type="number" name="cantidad" min="1" max="50" required placeholder="Ej: 5">
            <button type="submit">Continuar</button>
        </form>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['cantidad']) && !isset($_POST['cantidad_notas'])) {
        // Paso 1: Mostrar formulario para ingresar las notas
        $cantidad = intval($_POST['cantidad']);
        
        if ($cantidad > 0 && $cantidad <= 50) {
            echo '<div>
                    📝 Ingrese las <strong>' . $cantidad . '</strong> notas
                </div>';
            
            echo '<form method="POST">
                    <input type="hidden" name="cantidad_notas" value="' . $cantidad . '">';
            
            for ($i = 1; $i <= $cantidad; $i++) {
                echo '<label>Nota ' . $i . ':</label>
                    <input type="number" step="0.01" name="nota' . $i . '" min="0" max="100" required placeholder="0-100">';
            }
            
            echo '<button type="submit">Calcular Estadísticas</button>
                </form>';
        } else {
            echo '<div>
                    <strong>❌ Error:</strong> Ingrese una cantidad entre 1 y 50.
                </div>';
            
            echo '<form method="POST">
                    <label>¿Cuántas notas desea ingresar?</label>
                    <input type="number" name="cantidad" min="1" max="50" required placeholder="Ej: 5">
                    <button type="submit">Continuar</button>
                </form>';
        }
    } elseif (isset($_POST['cantidad_notas'])) {
        // Paso 2: Calcular estadísticas
        $cantidad = intval($_POST['cantidad_notas']);
        $notas = [];
        
        // Usar foreach para recorrer los datos POST
        foreach ($_POST as $clave => $valor) {
            if (strpos($clave, 'nota') === 0 && $clave !== 'nota') {
                $notas[] = floatval($valor);
            }
        }
        
        if (count($notas) > 0) {
            $promedio = Estadisticas::calcularMedia($notas);
            $desviacion = Estadisticas::calcularDesviacionEstandar($notas);
            $minima = Estadisticas::obtenerMinimo($notas);
            $maxima = Estadisticas::obtenerMaximo($notas);
            
            echo '<div>
                    <h2>📊 Resultados Estadísticos</h2>
                    
                    <div>
                        <span>Cantidad de Notas:</span>
                        <span>' . count($notas) . '</span>
                    </div>
                    
                    <div>
                        <span>Promedio:</span>
                        <span>' . number_format($promedio, 2) . '</span>
                    </div>
                    
                    <div>
                        <span>Desviación Estándar:</span>
                        <span>' . number_format($desviacion, 2) . '</span>
                    </div>
                    
                    <div>
                        <span>Nota Mínima:</span>
                        <span>' . number_format($minima, 2) . '</span>
                    </div>
                    
                    <div>
                        <span>Nota Máxima:</span>
                        <span>' . number_format($maxima, 2) . '</span>
                    </div>
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