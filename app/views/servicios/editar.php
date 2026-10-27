<h1>Editar Servicio</h1>

<?php if (!empty($error)): ?>
    <div class="error"><?php echo $error; ?></div>
<?php endif; ?>

<div class="card" style="max-width: 600px; margin: 0 auto;">
    <form action="index.php?action=editar&id=<?php echo $servicio['id']; ?>" method="POST">
        <input type="hidden" name="csrf_token" value="<?php echo generarCSRFToken(); ?>">

        <div class="campo">
            <label for="nombre">Nombre del Servicio:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($servicio['nombre']); ?>" required>
        </div>

        <div class="campo">
            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" rows="4" required><?php echo htmlspecialchars($servicio['descripcion']); ?></textarea>
        </div>

        <div class="campo">
            <label for="precio">Precio (MXN):</label>
            <input type="number" step="0.01" id="precio" name="precio" value="<?php echo htmlspecialchars($servicio['precio']); ?>" required>
        </div>

        <button type="submit">Actualizar Servicio</button>
    </form>
</div>

<div style="text-align: center;">
    <a href="index.php?action=index" class="link-volver">← Volver al Panel</a>
</div>