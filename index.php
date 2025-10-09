<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Menú Principal - MiniProyecto 1</title>
    <link rel="stylesheet" href="estilo.css"> <!-- Vincula el archivo CSS para estilos -->
</head>
<body>
<div class="container">
    <h1>MiniProyecto 1 - Menú Principal</h1>
    <h2>Selecciona un problema para ejecutar:</h2>

    <!-- Enlaces a cada uno de los problemas con botones -->
        <div class="menu-grid">
            <a href="Problema1.php" class="menu-item">
                <button class="menu-button">
                    <span class="icon">📊</span>
                    <span class="problem-number">Problema 1</span>
                    <div class="problem-title">Estadísticas de 5 números</div>
                </button>
            </a>

            <a href="Problema2.php" class="menu-item">
                <button class="menu-button">
                    <span class="icon">➕</span>
                    <span class="problem-number">Problema 2</span>
                    <div class="problem-title">Suma del 1 al 1000</div>
                </button>
            </a>

            <a href="Problema3.php" class="menu-item">
                <button class="menu-button">
                    <span class="icon">✖️</span>
                    <span class="problem-number">Problema 3</span>
                    <div class="problem-title">Múltiplos de 4</div>
                </button>
            </a>

            <a href="Problema4.php" class="menu-item">
                <button class="menu-button">
                    <span class="icon">🔢</span>
                    <span class="problem-number">Problema 4</span>
                    <div class="problem-title">Suma de Pares e Impares</div>
                </button>
            </a>

            <a href="Problema5.php" class="menu-item">
                <button class="menu-button">
                    <span class="icon">👥</span>
                    <span class="problem-number">Problema 5</span>
                    <div class="problem-title">Clasificación por Edades</div>
                </button>
            </a>

            <a href="Problema6.php" class="menu-item">
                <button class="menu-button">
                    <span class="icon">🏥</span>
                    <span class="problem-number">Problema 6</span>
                    <div class="problem-title">Presupuesto Hospital</div>
                </button>
            </a>

            <a href="Problema7.php" class="menu-item">
                <button class="menu-button">
                    <span class="icon">📈</span>
                    <span class="problem-number">Problema 7</span>
                    <div class="problem-title">Estadísticas de Notas</div>
                </button>
            </a>

            <a href="Problema8.php" class="menu-item">
                <button class="menu-button">
                    <span class="icon">🌸</span>
                    <span class="problem-number">Problema 8</span>
                    <div class="problem-title">Estación del Año</div>
                </button>
            </a>

            <a href="Problema9.php" class="menu-item">
                <button class="menu-button">
                    <span class="icon">⚡</span>
                    <span class="problem-number">Problema 9</span>
                    <div class="problem-title">Potencias de un Número</div>
                </button>
            </a>

            <a href="Problema10.php" class="menu-item">
                <button class="menu-button">
                    <span class="icon">💼</span>
                    <span class="problem-number">Problema 10</span>
                    <div class="problem-title">Sistema de Ventas</div>
                </button>
            </a>
</div>

<?php include 'footer.php'; // Incluye el pie de página con copyright u otra información ?>
</body>
</html>
