<form role="form" method="post">

    <?= validation_errors(); ?>

    <div class="form-body">

        <div class="form-group">

            <label>Título</label>

            <div class="input-group">

                <span class="input-group-addon">
                    <i class="fa fa-pencil"></i>
                </span>

                <input name="titulo" value="" class="form-control" placeholder="Título descriptivo" type="text">

            </div>

        </div>

        <div class="form-group">

            <label>Argumentario</label>

            <textarea class="form-control content-richtext" rows="3" name="argumentario"></textarea>

        </div>

        <div class="form-group">

            <label>Campañas</label>

            <select class="form-control" name="campaign">

                <option value=""></option>

                <?php foreach ($campaigns as $key => $campaign): ?>
                    
                    <option value="<?= $campaign->getId() ?>"><?= $campaign->getName() ?></option>

                <?php endforeach ?>

            </select>

        </div>
        

        <div class="form-group">

            <button name="submit" class="btn green" type="submit">Guardar</button>

        </div>

    </div>

</form>