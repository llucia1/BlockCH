<form role="form" method="post">

    <?= validation_errors(); ?>

    <div class="form-body">

        <div class="form-group">

            <label>Título</label>

            <div class="input-group">

                <span class="input-group-addon">
                    <i class="fa fa-pencil"></i>
                </span>

                <input name="name" value="<?= $getRow->getName() ?>" class="form-control" placeholder="Título descriptivo del formulario" type="text">

            </div>

        </div>

        <div class="form-group">

            <label>Campañas</label>

            <select class="form-control" name="campaign">

                <option value=""></option>

                <?php foreach ($campaigns as $key => $campaign): ?>
                    
                    <option <?php if( $campaign->getId() == $getRow->getCampaign()->getId() ) echo 'selected' ?>  value="<?= $campaign->getId() ?>"><?= $campaign->getName() ?></option>

                <?php endforeach ?>

            </select>

        </div>
        

        <div class="form-group">

            <button name="submit" class="btn green" type="submit">Guardar</button>

        </div>

    </div>

</form>