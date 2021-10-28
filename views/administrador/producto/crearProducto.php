<div class="contenedor">
    <h1>Crear Producto</h1>
    <?php foreach ($errores as $error) { ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php } ?>
    <form class="formulario" method="POST" enctype="multipart/form-data">
        <?php include __DIR__ . '/formulario.php'; ?>
        <div class="botones-form">
            <a href="/administrador/productos" class="boton boton-rojo">Volver</a>
            <input type="submit" class="boton boton-verde" value="Crear Producto">
        </div>
    </form>
</div>