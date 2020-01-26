<form role="form" method="post">

    <?= validation_errors(); ?>

    <div class="form-body">

        <div class="form-group">

            <label>Nombre</label>

            <div class="input-group">

                <span class="input-group-addon">
                    <i class="fa fa-pencil"></i>
                </span>

                <input name="nombre" value="<?= set_value('valor'); ?>" class="form-control" placeholder="Nombre del regalo" type="text">

            </div>

        </div>

        <div class="form-group">

            <button name="submit" class="btn green" type="submit">Guardar</button>

        </div>

    </div>

</form>