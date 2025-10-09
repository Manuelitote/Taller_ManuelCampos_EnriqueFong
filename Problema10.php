<?php
require_once 'Navegacion.php';
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
        <p>Calcular ventas de vendedores y productos</p>

<?php
// Inicializar variables de sesión si no existen
session_start();

if (!isset($_SESSION['ventas'])) {
    $_SESSION['ventas'] = array_fill(0, 5, array_fill(0, 4, 0)); // 5 productos x 4 vendedores
}

if (!isset($_SESSION['vendedores'])) {
    $_SESSION['vendedores'] = [
        1 => ['nombre' => '', 'apellido' => ''],
        2 => ['nombre' => '', 'apellido' => ''],
        3 => ['nombre' => '', 'apellido' => ''],
        4 => ['nombre' => '', 'apellido' => '']
    ];
}

// Procesar formulario de registro de vendedor
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['registrar_vendedor'])) {
    $numeroVendedor = intval($_POST['numero_vendedor']);
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    
    if ($numeroVendedor >= 1 && $numeroVendedor <= 4 && !empty($nombre) && !empty($apellido)) {
        $_SESSION['vendedores'][$numeroVendedor] = [
            'nombre' => $nombre,
            'apellido' => $apellido
        ];
        
        echo '<div class="resultado">
                <h2>✅ Vendedor Registrado</h2>
                <p>Vendedor #' . $numeroVendedor . ': ' . $nombre . ' ' . $apellido . '</p>
              </div>';
    }
}

// Procesar formulario de venta
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['registrar_venta'])) {
    $numeroVendedor = intval($_POST['vendedor']) - 1; // Convertir a índice 0-3
    $numeroProducto = intval($_POST['producto']) - 1; // Convertir a índice 0-4
    $valorVenta = floatval($_POST['valor']);
    
    if ($numeroVendedor >= 0 && $numeroVendedor <= 3 && 
        $numeroProducto >= 0 && $numeroProducto <= 4 && 
        $valorVenta > 0) {
        
        $_SESSION['ventas'][$numeroProducto][$numeroVendedor] += $valorVenta;
        
        echo '<div class="resultado">
                <h2>✅ Venta Registrada</h2>
                <p>Vendedor #' . ($numeroVendedor + 1) . ' - Producto #' . ($numeroProducto + 1) . ' - $' . number_format($valorVenta, 2) . '</p>
              </div>';
    }
}

?>

<div>
    <!-- Formulario de Registro de Vendedor -->
    <div class="container">
        <h2 style="color: #1e3c72; margin-bottom: 18px;">👤 Registrar Vendedor</h2>
        <form method="POST" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); padding: 25px; border-radius: 15px; border: 1px solid #dee2e6;">
            <label>Número de Vendedor (1-4):</label>
            <select name="numero_vendedor" required>
                <option value="">Seleccione...</option>
                <option value="1">Vendedor 1</option>
                <option value="2">Vendedor 2</option>
                <option value="3">Vendedor 3</option>
                <option value="4">Vendedor 4</option>
            </select>
            
            <label>Nombre:</label>
            <input type="text" name="nombre" required>
            
            <label>Apellido:</label>
            <input type="text" name="apellido" required>
            
            <button type="submit" name="registrar_vendedor">Registrar Vendedor</button>
        </form>
    </div>
    
    <!-- Formulario de Registro de Venta -->
    <div class="container">
        <h2 style="color: #1e3c72; margin-bottom: 18px;">💰 Registrar Venta</h2>
        <form method="POST" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); padding: 25px; border-radius: 15px; border: 1px solid #dee2e6;">
            <label>Vendedor:</label>
            <select name="vendedor" required>
                <option value="">Seleccione...</option>
                <?php
                for ($i = 1; $i <= 4; $i++) {
                    $vendedor = $_SESSION['vendedores'][$i];
                    $nombreCompleto = !empty($vendedor['nombre']) ? 
                        $vendedor['nombre'] . ' ' . $vendedor['apellido'] : 
                        'Vendedor ' . $i;
                    echo '<option value="' . $i . '">' . $i . ' - ' . $nombreCompleto . '</option>';
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
</div>

<!-- Listado de Vendedores Registrados -->
<div class="container">
    <h3>📋 Vendedores Registrados</h3>
    <table style="text-align: center;">
        <tr>
            <th>N°</th>
            <th>Nombre Completo</th>
            <th>Estado</th>
        </tr>
        <?php
        for ($i = 1; $i <= 4; $i++) {
            $vendedor = $_SESSION['vendedores'][$i];
            $nombreCompleto = !empty($vendedor['nombre']) ? 
                $vendedor['nombre'] . ' ' . $vendedor['apellido'] : 
                '<em style="color: #6c757d;">No registrado</em>';
            $estado = !empty($vendedor['nombre']) ? '✅ Activo' : '⚠️ Pendiente';
            
            echo '<tr>
                    <td>Vendedor ' . $i . '</td>
                    <td>' . $nombreCompleto . '</td>
                    <td>' . $estado . '</td>
                  </tr>';
        }
        ?>
    </table>
</div>

<!-- Tabla de Ventas (Arreglo Bidimensional) -->
<div class="container"">
    <h2>📊 Matriz de Ventas del Mes</h2>    
    <table style="text-align: center;">
        <tr>
            <th>Producto</th>
            <th>Vendedor 1</th>
            <th>Vendedor 2</th>
            <th>Vendedor 3</th>
            <th>Vendedor 4</th>
            <th style="background: #155724; color: white;">TOTAL PRODUCTO</th>
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
                
                $color = $valor > 0 ? '' : 'color: #6c757d;';
                echo '<td style="' . $color . '">$' . number_format($valor, 2) . '</td>';
            }
            
            // Total por producto
            echo '<td style="background: #d4edda; font-weight: bold;">$' . number_format($totalProducto, 2) . '</td>';
            echo '</tr>';
        }
        
        // Fila de totales por vendedor
        echo '<tr style="background: #f8f9fa; font-weight: bold;">';
        echo '<td style="background: #155724; color: white;">TOTAL VENDEDOR</td>';
        
        foreach ($totalesPorVendedor as $total) {
            echo '<td style="background: #d4edda;">$' . number_format($total, 2) . '</td>';
        }
        
        // Total general
        echo '<td style="background: #1e3c72; color: white;">$' . number_format($totalGeneral, 2) . '</td>';
        echo '</tr>';
        ?>
    </table>
</div>
    <form method="POST" style="margin-top: 25px;">
        <button type="submit" name="limpiar_datos" 
                style="background: linear-gradient(135deg, #dc3545 0%, #c82333 100%); width: auto; padding: 14px 35px;"
                onclick="return confirm('¿Está seguro de limpiar todos los datos?')">
                Limpiar Todos los Datos
        </button>
    </form>
<?php
// Limpiar datos
if (isset($_POST['limpiar_datos'])) {
    $_SESSION['ventas'] = array_fill(0, 5, array_fill(0, 4, 0));
    $_SESSION['vendedores'] = [
        1 => ['nombre' => '', 'apellido' => ''],
        2 => ['nombre' => '', 'apellido' => ''],
        3 => ['nombre' => '', 'apellido' => ''],
        4 => ['nombre' => '', 'apellido' => '']
    ];
    
    echo '<div>
            <h2> Datos Limpiados</h2>
          </div>';
}

Navegacion::volverAlMenu();
?>
</div>
    <?php include 'footer.php'; ?>
</body>
</html>