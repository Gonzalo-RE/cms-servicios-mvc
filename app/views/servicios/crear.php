<h1>Agregar Servicio</h1>

<?php if (!empty($error)): ?>
    <div class="error"><?php echo $error; ?></div>
<?php endif; ?>

<div class="card" style="max-width: 600px; margin: 0 auto;">
    <form action="index.php?action=crear" method="POST">
        <input type="hidden" name="csrf_token" value="<?php echo generarCSRFToken(); ?>">

        <div class="campo">
            <label for="nombre">Nombre del Servicio:</label>
            <input type="text" id="nombre" name="nombre" required placeholder="Ej: Desarrollo Web">
        </div>

        <div class="campo">
            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" rows="4" required placeholder="Detalles del servicio..."></textarea>
        </div>

        <div class="campo">
            <label for="precio">Precio (MXN):</label>
            <input type="number" step="0.01" id="precio" name="precio" required placeholder="3000.00">
        </div>

        <button type="submit">Guardar Servicio</button>
    </form>
</div>

<div style="text-align: center;">
    <a href="index.php?action=index" class="link-volver">← Volver al Panel</a>
</div>