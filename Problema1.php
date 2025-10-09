<?php require_once 'validaciones.php'; // Incluye las funciones de validación ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Problema 1</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
<div class="container">
<h2>Problema #1</h2>
<p>Calcular la media, desviación estándar, número mínimo y máximo de los 5 primeros números positivos introducidos.</p>

<!-- Formulario para ingresar 5 números positivos -->
<form method="post">
    <?php for($i=1; $i<=5; $i++): ?>
        <input type="number" name="num<?= $i ?>" placeholder="Número <?= $i ?>" min="0" required><br>
    <?php endfor; ?>
    <button type="submit" name="calcular">Calcular</button>
</form>

<?php
// Procesa los datos al enviar el formulario
if (isset($_POST['calcular'])) {
    $nums = [];
    // Valida y almacena los números ingresados
    for ($i=1; $i<=5; $i++) {
        $valor = $_POST["num$i"];
        if (!validarNumeroNoNegativo($valor)) {
            echo "<p style='color:red;'>Solo se permiten números mayores o iguales a 0.</p>";
            exit;
        }
        $nums[] = (float)$valor;
    }

    // Calcula media, mínimo, máximo y desviación estándar
    $media = array_sum($nums) / count($nums);
    $min = min($nums);
    $max = max($nums);
    $sumatoria = 0;
    foreach ($nums as $n) $sumatoria += pow($n - $media, 2);
    $desv = sqrt($sumatoria / count($nums));

    // Muestra los resultados
    echo "<h3>Resultados:</h3>";
    echo "Media: $media <br>Desviación estándar: $desv <br>Mínimo: $min <br>Máximo: $max";
}
?>
<p><a href="index.php">← Volver al menú principal</a></p>
</div>
<?php include 'footer.php'; // Incluye el pie de página ?>
</body>
</html>
