<form role="form" method="post">

    <?= validation_errors(); ?>

    <div class="form-body">

        <div class="form-group">

            <label>Título</label>

            <div class="input-group">

                <span class="input-group-addon">
                    <i class="fa fa-pencil"></i>
                </span>

                <input name="title" value="<?= $getRow->getTitle() ?>" class="form-control" placeholder="Título de la plantilla" type="text">

            </div>

        </div>

        <div class="form-group">

            <label>Texto</label>

            <textarea class="form-control content-richtext" rows="3" name="text"><?= $getRow->getText() ?></textarea>

        </div>

        <div class="form-group">

            <a href="<?= site_url($path) ?>" class="btn default" type="button">Volver</a>
            <button name="submit" class="btn green" type="submit">Guardar</button>

        </div>

    </div>

</form>