<form role="form" method="post">

    <?= validation_errors(); ?>

    <div class="form-body">

        <div class="form-group">

            <label>Nombre</label>

            <div class="input-group">

                <span class="input-group-addon">
                    <i class="fa fa-pencil"></i>
                </span>

                <input name="nombre" value="<?= $getRow->getName() ?>" class="form-control" placeholder="Nombre motivo" type="text">

            </div>

        </div>

        <div class="form-group">

            <a href="<?= site_url($path) ?>" class="btn default" type="button">Volver</a>
            <button name="submit" class="btn green" type="submit">Guardar</button>

        </div>

    </div>

</form>