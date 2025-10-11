<?php
require_once 'Navegacion.php';
require_once 'validaciones.php'; // Incluir validaciones
session_start(); // Iniciar sesión para almacenar datos
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Problema 10</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <div class="container">
        <h2>Problema #10</h2>
        <p>💰 Sistema de Gestión de Ventas</p>
<!-- Formulario de Registro de Vendedor -->
<div class="container">
    <h3>👤 Registrar Vendedor</h3>
    <form method="POST">
        <label>Número de Vendedor (1-4):</label>
        <select name="numero_vendedor" required>
            <option value="">Seleccione...</option>
            <?php
            // Generar opciones con nombres actuales
            for ($i = 1; $i <= 4; $i++) {
                $vendedor = $_SESSION['vendedores'][$i];
                $nombreCompleto = $vendedor['nombre'] . ' ' . $vendedor['apellido'];
                echo '<option value="' . $i . '">' . $i . ' - ' . sanitizarTexto($nombreCompleto) . '</option>';
            }
            ?>
        </select>
        
        <label>Nombre:</label>
        <input type="text" name="nombre" required placeholder="Ej: Juan">
        
        <label>Apellido:</label>
        <input type="text" name="apellido" required placeholder="Ej: Pérez">
        
        <button type="submit" name="registrar_vendedor">Actualizar Vendedor</button>
    </form>
</div>

<!-- Formulario de Registro de Venta -->
<div class="container">
    <h3>💰 Registrar Venta</h3>
    <form method="POST">
        <label>Vendedor:</label>
        <select name="vendedor" required>
            <option value="">Seleccione...</option>
            <?php
            // Generar opciones de vendedores con nombres
            for ($i = 1; $i <= 4; $i++) {
                $vendedor = $_SESSION['vendedores'][$i];
                $nombreCompleto = $vendedor['nombre'] . ' ' . $vendedor['apellido'];
                echo '<option value="' . $i . '">' . $i . ' - ' . sanitizarTexto($nombreCompleto) . '</option>';
            }
            ?>
        </select>
        
        <label>Producto (1-5):</label>
        <select name="producto" required>
            <option value="">Seleccione...</option>
            <option value="1">Producto 1</option>
            <option value="2">Producto 2</option>
            <option value="3">Producto 3</option>
            <option value="4">Producto 4</option>
            <option value="5">Producto 5</option>
        </select>
        
        <label>Valor Total de Venta ($):</label>
        <input type="number" step="0.01" name="valor" min="0.01" required placeholder="Ej: 500.00">
        
        <button type="submit" name="registrar_venta">Registrar Venta</button>
    </form>
</div>

<?php

// Inicializar variables de sesión si no existen
if (!isset($_SESSION['ventas'])) {
    // Matriz 5 productos x 4 vendedores
    $_SESSION['ventas'] = array_fill(0, 5, array_fill(0, 4, 0));
}

if (!isset($_SESSION['vendedores'])) {
    // Datos de vendedores
    $_SESSION['vendedores'] = [
        1 => ['nombre' => '', 'apellido' => 'Vendedor 1'],
        2 => ['nombre' => '', 'apellido' => 'Vendedor 2'],
        3 => ['nombre' => '', 'apellido' => 'Vendedor 3'],
        4 => ['nombre' => '', 'apellido' => 'Vendedor 4']
    ];
}

// Procesar formulario de registro de vendedor
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['registrar_vendedor'])) {
    $numeroVendedor = intval($_POST['numero_vendedor']);
    $nombre = sanitizarTexto($_POST['nombre'] ?? '');
    $apellido = sanitizarTexto($_POST['apellido'] ?? '');
    
    // Validar datos del vendedor
    if (validarEnteroEnRango($numeroVendedor, 1, 4) && 
        validarNombre($nombre) && 
        validarNombre($apellido)) {
        
        $_SESSION['vendedores'][$numeroVendedor] = [
            'nombre' => $nombre,
            'apellido' => $apellido
        ];
        
        echo '<div class="container">
                <h2>✅ Vendedor Registrado</h2>
                <p>Vendedor #' . $numeroVendedor . ': ' . $nombre . ' ' . $apellido . '</p>
              </div>';
    } else {
        echo '<div>
                <strong>❌ Error:</strong> Datos del vendedor no válidos.
              </div>';
    }
}

// Procesar formulario de venta
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['registrar_venta'])) {
    $numeroVendedor = intval($_POST['vendedor']) - 1; // Convertir a índice 0-3
    $numeroProducto = intval($_POST['producto']) - 1; // Convertir a índice 0-4
    $valorVenta = $_POST['valor'] ?? '';
    
    // Validar datos de la venta
    if (validarEnteroEnRango($numeroVendedor + 1, 1, 4) && 
        validarEnteroEnRango($numeroProducto + 1, 1, 5) && 
        validarMontoVenta($valorVenta)) {
        
        $_SESSION['ventas'][$numeroProducto][$numeroVendedor] += floatval($valorVenta);
        
        echo '<div class="container">
                <h2>✅ Venta Registrada</h2>
                <p>Vendedor #' . ($numeroVendedor + 1) . ' - Producto #' . ($numeroProducto + 1) . ' - $' . number_format($valorVenta, 2) . '</p>
              </div>';
    } else {
        echo '<div>
                <strong>❌ Error:</strong> Datos de venta no válidos.
              </div>';
    }
}

// Limpiar datos
if (isset($_POST['limpiar_datos'])) {
    $_SESSION['ventas'] = array_fill(0, 5, array_fill(0, 4, 0));
    $_SESSION['vendedores'] = [
        1 => ['nombre' => '', 'apellido' => 'Vendedor 1'],
        2 => ['nombre' => '', 'apellido' => 'Vendedor 2'],
        3 => ['nombre' => '', 'apellido' => 'Vendedor 3'],
        4 => ['nombre' => '', 'apellido' => 'Vendedor 4']
    ];

    echo '<div class="container">
            <h2>🗑️ Datos Limpiados</h2>
            <p>Todos los datos han sido reiniciados.</p>
          </div>';
}
?>

<!-- Tabla de Ventas (Matriz Bidimensional) con nombres de vendedores -->
<div>
    <h3>📊 Matriz de Ventas del Mes</h3>    
    <table class="ventas-table">
        <tr>
            <th>Producto / Vendedor</th>
            <?php
            // Encabezados con nombres de vendedores
            for ($i = 1; $i <= 4; $i++) {
                $vendedor = $_SESSION['vendedores'][$i];
                $nombreCorto = substr($vendedor['nombre'], 0, 1) . '. ' . $vendedor['apellido'];
                echo '<th>' . sanitizarTexto($nombreCorto) . '</th>';
            }
            ?>
            <th class="total">TOTAL PRODUCTO</th>
        </tr>
        
        <?php
        $ventas = $_SESSION['ventas'];
        $totalesPorVendedor = [0, 0, 0, 0];
        $totalGeneral = 0;
        
        // Recorrer productos (filas)
        for ($producto = 0; $producto < 5; $producto++) {
            echo '<tr>';
            echo '<td><strong>Producto ' . ($producto + 1) . '</strong></td>';
            
            $totalProducto = 0;
            
            // Recorrer vendedores (columnas)
            for ($vendedor = 0; $vendedor < 4; $vendedor++) {
                $valor = $ventas[$producto][$vendedor];
                $totalProducto += $valor;
                $totalesPorVendedor[$vendedor] += $valor;
                $totalGeneral += $valor;
                
                $estilo = $valor > 0 ? '' : 'color: #6c757d;';
                echo '<td style="' . $estilo . '">$' . number_format($valor, 2) . '</td>';
            }
            
            // Total por producto
            echo '<td class="total">$' . number_format($totalProducto, 2) . '</td>';
            echo '</tr>';
        }
        
        // Fila de totales por vendedor
        echo '<tr class="totales-fila">';
        echo '<td class="total"><strong>TOTAL VENDEDOR</strong></td>';
        
        foreach ($totalesPorVendedor as $total) {
            echo '<td class="total"><strong>$' . number_format($total, 2) . '</strong></td>';
        }
        
        // Total general
        echo '<td class="total-general"><strong>$' . number_format($totalGeneral, 2) . '</strong></td>';
        echo '</tr>';
        ?>
    </table>
</div>

<!-- Botón para limpiar datos -->
<form method="POST">
    <button type="submit" name="limpiar_datos" 
            onclick="return confirm('¿Está seguro de limpiar todos los datos?')">
            🗑️ Limpiar Todos los Datos
    </button>
</form>

<?php
// Navegación para volver al menú
Navegacion::volverAlMenu();
?>
</div>
    <?php include 'footer.php'; ?>
</body>
</html>