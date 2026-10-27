<?php 
$tituloPagina = "Editar Servicio #" . $servicio['id'] . " | MVC";
require_once __DIR__ . '/../templates/header.php'; 
?>

<div class="contenedor" style="max-width: 500px;">
    <h2>Editar Servicio #<?php echo $servicio['id']; ?></h2>

    <?php if (!empty($mensaje)): ?>
        <div class="<?php echo $tipoMensaje; ?>"><?php echo $mensaje; ?></div>
    <?php endif; ?>

    <form action="index.php?action=editar" method="POST">
        <!-- Token CSRF Oculto e ID del Servicio -->
        <input type="hidden" name="csrf_token" value="<?php echo generarCSRFToken(); ?>">
        <input type="hidden" name="id" value="<?php echo $servicio['id']; ?>">

        <div class="campo">
            <label for="nombre">Nombre del Servicio:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($servicio['nombre']); ?>" required>
        </div>

        <div class="campo">
            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" rows="3" required><?php echo htmlspecialchars($servicio['descripcion']); ?></textarea>
        </div>

        <div class="campo">
            <label for="precio">Precio (MXN):</label>
            <input type="number" step="0.01" id="precio" name="precio" value="<?php echo $servicio['precio']; ?>" required>
        </div>

        <button type="submit">Actualizar Cambios</button>
    </form>

    <a href="index.php?action=index" class="link-volver">← Volver al Panel de Servicios</a>
</div>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>