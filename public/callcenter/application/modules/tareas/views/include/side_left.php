<div class="portlet-title">

    <h3>Información</h3>

</div>

<div class="form-group">

    <label>Tipo</label>
    <input disabled class="form-control spinner" value="<?= $getCuSegui->getTipo() ?>" type="text">

</div>

<div class="form-group">

    <label>Cliente</label>
    <input disabled class="form-control spinner" value="<?= $getRow->getIdcliente()->getNombre() ?>" type="text">

</div>

<div class="form-group">

    <label>Teléfono</label>

    <div class="input-group">

        <span class="input-group-addon">

            <i class="fa fa-pencil"></i>

        </span>

        <input disabled table="cuentas" field="telefono" key="<?= $getRow->getIdcliente()->getId() ?>" name="telefono" value="<?= $getRow->getIdcliente()->getTelefono() ?>" class="form-control md-text" type="text">

    </div>

</div>

<div class="form-group">

    <label>Persona de contacto</label>

    <div class="input-group">

        <span class="input-group-addon">

            <i class="fa fa-pencil"></i>

        </span>

        <input table="cuentas" field="personacnt" key="<?= $getRow->getIdcliente()->getId() ?>" name="telefono" value="<?= $getRow->getIdcliente()->getPersonacnt() ?>" class="form-control md-text" type="text">

    </div>

</div>

<div class="form-group">

    <label>Teléfono Alt.</label>

    <div class="input-group">

        <span class="input-group-addon">

            <i class="fa fa-pencil"></i>

        </span>

        <input table="cuentas" field="telefonoalt" key="<?= $getRow->getIdcliente()->getId() ?>" name="telefono" value="<?= $getRow->getIdcliente()->getTelefonoalt() ?>" class="form-control md-text" type="text">

    </div>

</div>

<div class="form-group">

    <label>Email</label>

    <div class="input-group">

        <span class="input-group-addon">

            <i class="fa fa-pencil"></i>

        </span>

        <input table="cuentas" field="email" key="<?= $getRow->getIdcliente()->getId() ?>" name="email" value="<?= $getRow->getIdcliente()->getEmail() ?>" class="form-control" type="text">

    </div>

</div>

<div class="form-group">

    <label>CP</label>

    <div class="input-group">

        <span class="input-group-addon">

            <i class="fa fa-pencil"></i>

        </span>

        <input disabled table="cuentas" field="cp" key="<?= $getRow->getIdcliente()->getId() ?>" name="direccion" value="<?= $getRow->getIdcliente()->getCp() ?>" class="form-control" type="text">

    </div>

</div>

<div class="form-group">

    <label>Población</label>

    <div class="input-group">

        <span class="input-group-addon">

            <i class="fa fa-pencil"></i>

        </span>

        <input disabled table="cuentas" field="poblacion" key="<?= $getRow->getIdcliente()->getId() ?>" name="direccion" value="<?= $getRow->getIdcliente()->getPoblacion() ?>" class="form-control" type="text">

    </div>

</div>

<div class="form-group">

    <label>Dirección</label>

    <div class="input-group">

        <span class="input-group-addon">

            <i class="fa fa-pencil"></i>

        </span>

        <input table="cuentas" field="direccion" key="<?= $getRow->getIdcliente()->getId() ?>" name="direccion" value="<?= $getRow->getIdcliente()->getDireccion() ?>" class="form-control" type="text">

    </div>

</div>

<?php if($getRow->getIdusuarioto()->getId() == 21): ?>

    <div class="form-group">

        <label>Fecha</label>
        <input disabled class="form-control spinner" value="<?= $getReporte->getFreporte()->format("d/m/Y") ?>" type="text">

    </div>

    <div class="form-group">

        <label>Comercial</label>
        <input disabled class="form-control spinner" value="<?= $getRow->getIdusuariofrom()->getNombre() ?> <?= $getRow->getIdusuariofrom()->getApellidos() ?>" type="text">

    </div>

 <?php else: ?>

    <div class="form-group">

        <label>Fecha del reporte</label>
        <input disabled class="form-control spinner" value="<?= $getReporte->getFreporte()->format("d/m/Y") ?>" type="text">

    </div>

    <div class="form-group">

        <label>Estado</label>
        <input disabled class="form-control spinner" value="<?= $getCuSegui->getIdestado()->getNombre() ?>" type="text">

    </div>

    <div class="form-group">

        <label>Comercial</label>
        <input disabled class="form-control spinner" value="<?= $getRow->getIdusuariofrom()->getNombre() ?> <?= $getRow->getIdusuariofrom()->getApellidos() ?>" type="text">

    </div>

    <div class="form-group">
        <label>Reportes</label>
        
        <div class="mt-comments">

        <?php foreach ($getReports as $key => $report): ?>

            <div class="mt-comment">

                <div class="mt-comment-img">
                    
                    <?php if($report->getIdusuario()->getImg() != null): ?>

                        <img width="45" class="page-lock-img" src="<?= base_url('assets/pages/media/users/'.$report->getIdusuario()->getImg()) ?>" alt="avatar">

                    <?php else: ?>

                        <img width="45" class="page-lock-img" src="<?= base_url('assets/pages/media/profile/avatar.png') ?>" alt="avatar">

                    <?php endif ?>

                </div>

                <div class="mt-comment-body">

                    <div class="mt-comment-info">
                        <span class="mt-comment-author"><?= $report->getIdusuario()->getNombre() ?> <?= $report->getIdusuario()->getApellidos() ?></span>
                        <span class="mt-comment-date"><?= $report->getFreporte()->format('d/m/Y') ?></span>
                    </div>

                    <div class="mt-comment-text"> 
                        <?= $report->getComentario() ?> 
                    </div>

                </div>

            </div>

        <?php endforeach ?>
        
        </div>

    </div>

<?php endif ?>
