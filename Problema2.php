<?php
require_once 'validaciones.php'; // Incluye las funciones de validación
require_once 'Navegacion.php';
require_once 'Operaciones.php'; 
?>
<!DOCTYPE html> 
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Problema 2</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
<div class="container">
<h2>Problema #2</h2>
<p>Calcular la suma de los números del 1 al 1000.</p>

<!-- Formulario para ejecutar el cálculo -->
<form method="post">
    <button type="submit" name="calcular">Calcular</button>
</form>

<?php
// Ejecuta el cálculo al presionar el botón
if (isset($_POST['calcular'])) {
    // 🔹 Se llama a la función dentro de la clase
    $suma = Operaciones::sumarHastaMil();

    // Muestra el resultado
    echo "<h3>Resultado:</h3> La suma de los números del 1 al 1000 es: <strong>$suma</strong>";
}
Navegacion::volverAlMenu();
?>

</div>
<?php include 'footer.php'; // Incluye el pie de página ?>
</body>
</html>
