<?php require_once 'Navegacion.php';?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Problema 4</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
<div class="container">
<h2>Problema #4</h2>
<p>Calcular independientemente la suma de los números pares e impares entre 1 y 200.</p>

<!-- Formulario para calcular la suma -->
<form method="post">
    <button type="submit" name="calcular">Calcular</button>
</form>

<?php
// Ejecuta el cálculo al presionar el botón
if (isset($_POST['calcular'])) {
    $sumaPares = 0;
    $sumaImpares = 0;
    for ($i = 1; $i <= 200; $i++) {
        if ($i % 2 == 0) $sumaPares += $i; // Suma pares
        else $sumaImpares += $i;           // Suma impares
    }
    // Muestra los resultados
    echo "<h3>Resultados:</h3>";
    echo "Suma de pares: $sumaPares<br>";
    echo "Suma de impares: $sumaImpares<br>";
}
Navegacion::volverAlMenu();
?>
</div>
<?php include 'footer.php'; // Incluye el pie de página ?>
</body>
</html>
