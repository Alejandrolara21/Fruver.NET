<fieldset>
    <legend>Informacion General</legend>
    <label for="referencia">Referencia:</label>
    <input type="number" id="referencia" name="producto[referencia]" placeholder="Referencia producto" value="<?php echo sanitizarHtml($producto->referencia); ?>" <?php echo $bandReferencia ? '' : 'disabled'; ?>>

    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="producto[nombre]" placeholder="Nombre producto" value="<?php echo sanitizarHtml($producto->nombre); ?>">

    <label for="precio">Precio:</label>
    <input type="number" id="precio" name="producto[precio]" placeholder="Precio producto" value="<?php echo sanitizarHtml($producto->precio); ?>">

    <label for="cantidad">Cantidad:</label>
    <input type="number" id="cantidad" name="producto[cantidad]" placeholder="Cantidad producto" value="<?php echo sanitizarHtml($producto->cantidad); ?>">

    <label for="descripcion">Descripcion:</label>
    <textarea id="descripcion" name="producto[descripcion]"><?php echo sanitizarHtml($producto->descripcion); ?></textarea>

</fieldset>

<fieldset>
    <legend>Tipo</legend>
    <select name="producto[id_tipo_prod]" id="tipo">
        <option selected value="">--Seleccione--</option>
        <?php foreach ($tipo as $tipos) { ?>
            <option <?php echo $producto->id_tipo_prod === $tipos->id ? 'selected' : ''; ?> value="<?php echo sanitizarHtml($tipos->id); ?>"><?php echo sanitizarHtml($tipos->nombre) ?></option>
        <?php } ?>
    </select>
</fieldset>

<fieldset>
    <legend>Imagenes Producto</legend>
    <label for="imagen">Imagen:</label>
    <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen[]" multiple>
    <?php if ($imagenes) {
        foreach ($imagenes as $imagen) {
    ?>
            <div class="display_flex">
                <img data-imagenProducto="<?php echo $imagen->nombre; ?>" src="/imagenes/<?php echo $imagen->nombre; ?>" alt="Imagen de propiedad " class="imagen-small">
                <a id="<?php echo $imagen->nombre; ?>" class="boton_form_imagen">X</a>
            </div>
        <?php }
    } else {
        ?>
        <p>NO hay imagenes agregadas</p>
    <?php } ?>
    <div class="hidden imagenes_eliminadas"></div>
</fieldset>