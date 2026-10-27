<?php 
$tituloPagina = "Panel de Servicios | MVC";
require_once __DIR__ . '/../templates/header.php'; 
?>

<h1 style="text-align: center;">Gestión de Servicios (Patrón MVC)</h1>

<?php if (isset($_SESSION['usuario_rol']) && $_SESSION['usuario_rol'] === 'admin'): ?>
    <div style="text-align: center; margin-bottom: 20px;">
        <a href="index.php?action=crear" class="btn-crear">+ Agregar Nuevo Servicio</a>
    </div>
<?php endif; ?>

<div class="grid">
    <?php if (!empty($servicios)): ?>
        <?php foreach ($servicios as $servicio): ?>
            <div class="card">
                <h3><?php echo htmlspecialchars($servicio['nombre']); ?></h3>
                <p><?php echo htmlspecialchars($servicio['descripcion']); ?></p>
                <p class="precio">$<?php echo number_format($servicio['precio'], 2); ?> MXN</p>
                
                <?php if (isset($_SESSION['usuario_rol']) && $_SESSION['usuario_rol'] === 'admin'): ?>
                    <div style="margin-top: 15px;">
                        <a href="index.php?action=editar&id=<?php echo $servicio['id']; ?>" class="btn-editar">✏️ Editar</a>
                        <a href="index.php?action=eliminar&id=<?php echo $servicio['id']; ?>" 
                           onclick="return confirm('¿Estás seguro de que deseas eliminar este servicio?');" 
                           class="btn-eliminar">
                           🗑️ Eliminar
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p style="text-align: center; grid-column: 1 / -1;">No hay servicios registrados en la base de datos.</p>
    <?php endif; ?>
</div>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>