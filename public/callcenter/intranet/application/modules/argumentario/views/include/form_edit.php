<form role="form" method="post">

    <?= validation_errors(); ?>

    <div class="form-body">

        <div class="form-group">

            <label>Título</label>

            <div class="input-group">

                <span class="input-group-addon">
                    <i class="fa fa-pencil"></i>
                </span>

                <input name="titulo" value="<?= $getRow->getTitle() ?>" class="form-control" placeholder="Título descriptivo" type="text">

            </div>

        </div>

        <div class="form-group">

            <label>Argumentario</label>

            <textarea class="form-control content-richtext" rows="3" name="argumentario"><?= $getRow->getArgumentario() ?></textarea>

        </div>

        <div class="form-group">

            <label>Campañas</label>

            <select class="form-control" name="campaign">

                <option value=""></option>

                <?php foreach ($campaigns as $key => $campaign): ?>
                    
                    <option <?php if( $getRow->getCampaign()->getId() == $campaign->getId() ) echo 'selected' ?>  value="<?= $campaign->getId() ?>"><?= $campaign->getName() ?></option>

                <?php endforeach ?>

            </select>

        </div>

        <div class="form-group">

            <a href="<?= site_url($path) ?>" class="btn default" type="button">Volver</a>
            <button name="submit" class="btn green" type="submit">Guardar</button>

        </div>

    </div>

</form>

<hr/>

<h4>Acciones</h4>

<form action="<?= site_url('/argumentario/setAction/'.$id) ?>" class="form-inline" role="form" method="post">

    <div class="form-body">

        <div style="margin-right: 10px;" class="form-group">

            <label>Título</label>

            <div style="width: 300px;" class="input-group">

                <input name="titulo" value="" class="form-control" placeholder="Título de la acción" type="text">

            </div>

        </div>

        <div style="margin-right: 10px;" class="form-group">

            <label>Acción</label>

            <select name="parentId" class="form-control">
                
                <?php foreach ($getResult as $key => $value): ?>
                  
                    <?php if( $value->getId() != $id ): ?>

                        <option value="<?= $value->getId() ?>"><?= $value->getTitle() ?></option>

                    <?php endif ?>

                <?php endforeach ?>
                

            </select>

        </div>

        <div class="form-group">

            <button name="submit" class="btn green" type="submit"><i class=" icon-plus " ></i> Crear</button>

        </div>

    </div>

</form>

<hr/>

<table class="table table-bordered table-striped table-condensed flip-content">

    <thead class="flip-content">
        <tr>
            <th width="20%"> ID </th>
            <th width="20%"> Título </th>
            <th width="20%"> Acción </th>
            <th width="20%">Acciones</th>
        </tr>
    </thead>

    <tbody>

        <?php foreach ($acciones as $key => $value): ?>
            
            <?php $accion = $this->doctrine->em->getRepository("Entities\\Argumentarios")->findOneBy(["id" => $value->getParentId()]); ?>
            <tr>
                <td> <?= $value->getId() ?> </td>
                <td> <?= $value->getRespuesta() ?> </td>
                <td> <?= $accion->getTitle() ?> </td>
                <td>
                    <!--<a title="Editar" href="<?= site_url($path.'/edit/'.$value->getId()) ?>" class="btn yellow" type="button"><i class=" icon-pencil "></i></a>-->
                    <a title="Eliminar" href="<?= site_url('argumentario/deleteAction/'.$id.'/'.$value->getId()) ?>" class="btn red" type="button"><i class="icon-trash "></i></a>
                </td>
            </tr>

        <?php endforeach ?>

    </tbody>
        

</table>