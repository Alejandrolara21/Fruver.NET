<div class="contenedor">
    <h1 data-cy="heading-administrador">Administrador de productos</h1>
    <?php
    if ($mensaje) {

        $notificacion = mostrarNotificacion(intval($mensaje));
        if ($notificacion) {
    ?>
            <p class="alerta exito"><?php echo sanitizarHtml($notificacion); ?></p>
    <?php }
    } ?>
    <a href="/administrador/productosCrear" class="boton boton-verde">Crear producto</a>

    <table class="tabla_producto">
        <thead>
            <th>Referencia</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Estado</th>
            <th>Actividad</th>
        </thead>
        <tbody>
            <?php foreach ($productos as $producto) { ?>
                <tr>
                    <td><?php echo ($producto->referencia) ?></td>
                    <td><?php echo ($producto->nombre) ?></td>
                    <td><?php echo ($producto->precio) ?></td>
                    <td><?php echo ($producto->cantidad) ?></td>
                    <td><?php echo ($producto->id_estado_prod) ?></td>
                    <td>
                        <a href="/administrador/productosActualizar?id=<?php echo($producto -> referencia);?>"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit-circle" width="28" height="28" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 15l8.385 -8.415a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3z" />
                                <path d="M16 5l3 3" />
                                <path d="M9 7.07a7.002 7.002 0 0 0 1 13.93a7.002 7.002 0 0 0 6.929 -5.999" />
                            </svg>
                        </a>
                        <p class="ver_informacion" data-producto="<?php echo $producto->referencia; ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-info-circle" width="28" height="28" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <circle cx="12" cy="12" r="9" />
                                <line x1="12" y1="8" x2="12.01" y2="8" />
                                <polyline points="11 12 12 12 12 16 13 16" />
                            </svg>
                        </p>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    
    <div class="hidden">
        <p class="imagenes-productos"><?php echo json_encode($imagenes);?></p>
        <p class="datos-productos"><?php echo json_encode($productos);?></p>
    </div>
</div>