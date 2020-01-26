<form role="form" method="post">

    <?= validation_errors(); ?>

    <div class="form-body">

        <div class="form-group">

            <label>Venta</label>

            <div class="input-group">

                <span class="input-group-addon">
                    <i class="fa fa-pencil"></i>
                </span>

                <input name="valor" value="<?= $getRow->getValor() ?>" class="form-control" placeholder="Nombre del Rol" type="text">

            </div>

        </div>

        <div class="form-group">

            <a href="<?= site_url($path) ?>" class="btn default" type="button">Volver</a>
            <button name="submit" class="btn green" type="submit">Guardar</button>

        </div>

    </div>

</form>