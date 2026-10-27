<h1>Gestión de Servicios</h1>

<?php if (($_SESSION['usuario_rol'] ?? '') === 'admin'): ?>
    <div style="text-align: center; margin-bottom: 30px;">
        <a href="index.php?action=crear" class="btn-crear">➕ Agregar Nuevo Servicio</a>
    </div>
<?php endif; ?>

<div class="grid">
    <?php foreach ($servicios as $servicio): ?>
        <div class="card">
            <div>
                <h3><?php echo htmlspecialchars($servicio['nombre']); ?></h3>
                <p><?php echo htmlspecialchars($servicio['descripcion']); ?></p>
            </div>
            <div>
                <p class="precio">$<?php echo number_format($servicio['precio'], 2); ?> MXN</p>
                <?php if (($_SESSION['usuario_rol'] ?? '') === 'admin'): ?>
                    <div style="margin-top: 15px;">
                        <a href="index.php?action=editar&id=<?php echo $servicio['id']; ?>" class="btn-editar">✏️ Editar</a>
                        <a href="index.php?action=eliminar&id=<?php echo $servicio['id']; ?>" class="btn-eliminar" onclick="return confirm('¿Eliminar servicio?');">🗑️ Eliminar</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>