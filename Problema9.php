<?php
require_once 'OperacionesMatematicas.php';
require_once 'Navegacion.php';
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
        <p>Calcular las 15 primeras potencias del número </p>
 <!-- Formulario HTML donde el usuario introduce un número -->
    <form method="POST">
        <label>Ingrese un número del 1 al 9:</label>
        <input type="number" name="numero" min="1" max="9" required placeholder="Ej: 4">
        <button type="submit">Calcular Potencias</button>
    </form>
<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Convierte el valor enviado en un número entero (por seguridad)
    $numero = intval($_POST['numero']);
    
    if ($numero >= 1 && $numero <= 9) {
        $potencias = OperacionesMatematicas::obtenerPotencias($numero, 15);
        

     // Imprime la tabla con los resultados
        echo '<div class="container">
                <h2>Las 15 Primeras Potencias de ' . $numero . '</h2>
                <table>
                    <tr>
                        <th>Expresión</th>
                        <th>Resultado</th>
                    </tr>';
     // Recorre cada potencia calculada y muestra una fila por cada resultado   
        foreach ($potencias as $potencia) {
            echo '<tr>
                    <td>' . $numero . ' <sup>' . $potencia['exponente'] . '</sup></td>
                    <td><strong>' . number_format($potencia['resultado'], 0) . '</strong></td>
                  </tr>';
        }
        
     // Cierra la tabla HTML    
        echo '</table></div>';
    } else {
        echo '<div>
                <strong>❌ Error:</strong> El número debe estar entre 1 y 9.
              </div>';
    }
}

Navegacion::volverAlMenu();
?>
</div>
    <?php include 'footer.php'; ?>
</body>
</html>