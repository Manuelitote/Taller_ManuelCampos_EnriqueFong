<?php
require_once 'Estadistica.php';
require_once 'Navegacion.php';
require_once 'validaciones.php'; // Incluir validaciones
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
        <p>📊 Calculadora de Estadísticas de Notas</p>
        
        <form method="POST">
            <label>¿Cuántas notas desea ingresar?</label>
            <input type="number" name="cantidad" min="1" max="50" required placeholder="Ej: 5">
            <button type="submit">Continuar</button>
        </form>

<?php
// Procesar cuando se envía el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Paso 1: Mostrar formulario para ingresar las notas
    if (isset($_POST['cantidad']) && !isset($_POST['cantidad_notas'])) {
        $cantidad = intval($_POST['cantidad']);
        
        // Validar cantidad de notas
        if (validarEnteroEnRango($cantidad, 1, 50)) {
            echo '<div class="info-box">
                    📝 Ingrese las <strong>' . $cantidad . '</strong> notas (0-100)
                  </div>';
            
            // Formulario para ingresar las notas
            echo '<form method="POST">
                    <input type="hidden" name="cantidad_notas" value="' . $cantidad . '">';
            
            // Generar campos para cada nota
            for ($i = 1; $i <= $cantidad; $i++) {
                echo '<label>Nota ' . $i . ':</label>
                      <input type="number" step="0.01" name="nota' . $i . '" min="0" max="100" required placeholder="0-100">';
            }
            
            echo '<button type="submit">Calcular Estadísticas</button>
                  </form>';
        } else {
            // Mostrar error si la cantidad no es válida
            echo '<div class="error-box">
                    <strong>❌ Error:</strong> Ingrese una cantidad entre 1 y 50.
                  </div>';
        }
        
    // Paso 2: Calcular estadísticas con las notas ingresadas
    } elseif (isset($_POST['cantidad_notas'])) {
        $cantidad = intval($_POST['cantidad_notas']);
        $notas = [];
        $errores = [];
        
        // Recoger y validar las notas
        for ($i = 1; $i <= $cantidad; $i++) {
            $clave = 'nota' . $i;
            if (isset($_POST[$clave])) {
                $nota = $_POST[$clave];
                
                // Validar cada nota
                if (validarNota($nota)) {
                    $notas[] = floatval($nota);
                } else {
                    $errores[] = "La nota $i no es válida (debe ser 0-100)";
                }
            }
        }
        
        // Si no hay errores, calcular estadísticas
        if (empty($errores) && count($notas) > 0) {
            
            // Llamar funciones estáticas de la clase Estadisticas
            $promedio = Estadisticas::calcularMedia($notas);
            $desviacion = Estadisticas::calcularDesviacionEstandar($notas);
            $minima = Estadisticas::obtenerMinimo($notas);
            $maxima = Estadisticas::obtenerMaximo($notas);
            
            // Mostrar resultados
            echo '<div class="resultado-box">
                    <h2>📊 Resultados Estadísticos</h2>
                    
                    <div class="resultado-item">
                        <span>Cantidad de Notas:</span>
                        <span>' . count($notas) . '</span>
                    </div>
                    
                    <div class="resultado-item">
                        <span>Promedio:</span>
                        <span>' . number_format($promedio, 2) . '</span>
                    </div>
                    
                    <div class="resultado-item">
                        <span>Desviación Estándar:</span>
                        <span>' . number_format($desviacion, 2) . '</span>
                    </div>
                    
                    <div class="resultado-item">
                        <span>Nota Mínima:</span>
                        <span>' . number_format($minima, 2) . '</span>
                    </div>
                    
                    <div class="resultado-item">
                        <span>Nota Máxima:</span>
                        <span>' . number_format($maxima, 2) . '</span>
                    </div>
                  </div>';
        } else {
            // Mostrar errores de validación
            echo '<div class="error-box">';
            foreach ($errores as $error) {
                echo '<p><strong>❌ ' . $error . '</strong></p>';
            }
            echo '</div>';
        }
    }
}

// Navegación para volver al menú
Navegacion::volverAlMenu();
?>
</div>
    <?php include 'footer.php'; ?>
</body>
</html>