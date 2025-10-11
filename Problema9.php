<?php
require_once 'Operaciones.php';
require_once 'Navegacion.php';
require_once 'validaciones.php'; // Incluir validaciones
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Problema 9</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <div class="container">
        <h2>Problema #9</h2>
        <p>🔢 Calculadora de Potencias</p>
        
        <!-- Formulario para ingresar el número -->
        <form method="POST">
            <label>Ingrese un número del 1 al 9:</label>
            <input type="number" name="numero" min="1" max="9" required placeholder="Ej: 4">
            <button type="submit">Calcular Potencias</button>
        </form>

<?php
// Procesar cuando se envía el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $numeroInput = $_POST['numero'] ?? '';
    
    // Validar el número ingresado
    if (validarEnteroEnRango($numeroInput, 1, 9)) {
        $numero = intval($numeroInput);
        
        // Obtener las 15 primeras potencias
        $potencias = Operaciones::obtenerPotencias($numero, 15);
        
        // Mostrar tabla con resultados
        echo '<div class="container">
                <h2>Las 15 Primeras Potencias de ' . $numero . '</h2>
                <table>
                    <tr>
                        <th>Expresión</th>
                        <th>Resultado</th>
                    </tr>';
        
        // Mostrar cada potencia en una fila de la tabla
        foreach ($potencias as $potencia) {
            echo '<tr>
                    <td>' . $numero . '<sup>' . $potencia['exponente'] . '</sup></td>
                    <td><strong>' . number_format($potencia['resultado'], 0) . '</strong></td>
                  </tr>';
        }
        
        echo '</table></div>';
    } else {
        // Mostrar error si el número no es válido
        echo '<div>
                <strong>❌ Error:</strong> El número debe estar entre 1 y 9.
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