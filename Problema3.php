<?php require_once 'validaciones.php'; // Incluye funciones de validación ?>
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
        // Imprime los múltiplos de 4
        for ($i = 1; $i <= $n; $i++) {
            echo "4 × $i = " . (4 * $i) . "<br>";
        }
    }
}
?>
<p><a href="index.php">← Volver al menú principal</a></p>
</div>
<?php include 'footer.php'; // Incluye el pie de página ?>
</body>
</html>
