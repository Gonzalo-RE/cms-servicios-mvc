<?php 
$tituloPagina = "Agregar Servicio | MVC";
require_once __DIR__ . '/../templates/header.php'; 
?>

<div class="contenedor" style="max-width: 500px;">
    <h2>Registrar Nuevo Servicio</h2>

    <?php if (!empty($mensaje)): ?>
        <div class="<?php echo $tipoMensaje; ?>"><?php echo $mensaje; ?></div>
    <?php endif; ?>

    <form action="index.php?action=crear" method="POST">
        <!-- Token CSRF Oculto -->
        <input type="hidden" name="csrf_token" value="<?php echo generarCSRFToken(); ?>">

        <div class="campo">
            <label for="nombre">Nombre del Servicio:</label>
            <input type="text" id="nombre" name="nombre" placeholder="Ej. Mantenimiento Web" required>
        </div>

        <div class="campo">
            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" rows="3" placeholder="Descripción detallada..." required></textarea>
        </div>

        <div class="campo">
            <label for="precio">Precio (MXN):</label>
            <input type="number" step="0.01" id="precio" name="precio" placeholder="Ej. 1500.00" required>
        </div>

        <button type="submit">Guardar Servicio</button>
    </form>

    <a href="index.php?action=index" class="link-volver">← Volver a la Lista de Servicios</a>
</div>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>