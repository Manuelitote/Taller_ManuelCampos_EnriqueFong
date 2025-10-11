<?php
require_once 'validaciones.php'; // Incluye funciones de validación 
require_once 'Navegacion.php';
require_once 'Operaciones.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Problema 3</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
<div class="container">
<h2>Problema #3</h2>
<p>Imprimir los N primeros múltiplos de 4.</p>

<!-- Formulario para ingresar N -->
<form method="post">
    <input type="number" name="n" placeholder="Valor de N" min="1" required>
    <button type="submit" name="calcular">Calcular</button>
</form>

<?php
// Procesa el cálculo al enviar el formulario
if (isset($_POST['calcular'])) {
    $n = $_POST['n'];
    if (!validarNumeroPositivo($n)) {
        echo "<p style='color:red;'>Ingrese un número positivo.</p>";
    } else {
        echo "<h3>Resultados:</h3>";
        // 🔹 Llamada al método dentro de la clase
        $multiplos = Operaciones::obtenerMultiplosDeCuatro($n);

        // 🔹 Muestra los resultados igual que antes
        foreach ($multiplos as $dato) {
            echo "4 × {$dato['multiplo']} = {$dato['resultado']}<br>";
        }
    }
}
Navegacion::volverAlMenu();
?>
</div>
<?php include 'footer.php'; // Incluye el pie de página ?>
</body>
</html>
