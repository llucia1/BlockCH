<form role="form" method="post">

    <?= validation_errors(); ?>

    <div class="form-body">

        <div class="form-group">

            <label>Razón social</label>

            <div class="input-group">

                <span class="input-group-addon">
                    <i class="fa fa-pencil"></i>
                </span>

                <input name="nombre" value="<?= set_value('nombre') ?>" class="form-control" placeholder="Nombre de  la empresa" type="text">

            </div>

        </div>

        <div class="form-group">

            <label>Teléfono</label>

            <div class="input-group">

                <span class="input-group-addon">
                    <i class="fa fa-pencil"></i>
                </span>

                <input name="telefono" value="<?= set_value('telefono') ?>" class="form-control" type="text">

            </div>

        </div>

        <div class="form-group">

            <label>Móvil</label>

            <div class="input-group">

                <span class="input-group-addon">
                    <i class="fa fa-pencil"></i>
                </span>

                <input name="movil" value="<?= set_value('movil') ?>" class="form-control" type="text">

            </div>

        </div>

        <div class="form-group">

            <label>Población</label>

            <div class="input-group">

                <span class="input-group-addon">
                    <i class="fa fa-pencil"></i>
                </span>

                <input name="poblacion" value="<?= set_value('poblacion') ?>" class="form-control" placeholder="nombre del municipio del cliente" type="text">

            </div>

        </div>

        <div class="form-group">

            <label>CP</label>

            <div class="input-group">

                <span class="input-group-addon">
                    <i class="fa fa-pencil"></i>
                </span>

                <input name="cp" value="<?= set_value('cp') ?>" class="form-control" placeholder="código postal" type="text">

            </div>

        </div>

        <div class="form-group">

            <button name="submit" class="btn green" type="submit">Guardar</button>

        </div>

    </div>

</form>