<div class="contenedor-dos seccion">
    <h1>Inicio de Sesion</h1>
    <form action="/login" class="formulario-login" method="POST">
        <fieldset>
            <legend>Datos</legend>
            <label for="correo">Correo Electronico</label>
            <input name="correo" type="text">
            <label for="password">Constraseña</label>
            <input name="contraseña" type="password">
        </fieldset>
        <?php foreach ($errores as $error) { ?>
                <div data-cy="alerta-login" class="alerta error"><?php echo $error; ?></div>
            <?php } ?>
        <input class="boton boton-verde-block" type="submit" value="Iniciar Sesion">
    </form>
</div>
