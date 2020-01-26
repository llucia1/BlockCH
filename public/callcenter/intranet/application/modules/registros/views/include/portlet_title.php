<div class="portlet-title">

    <?php if($this->uri->segment(2)  != 'add'): ?>

        <a href="<?= site_url($path.'/add') ?>" class="btn green" type="button"><i class=" icon-plus "></i> Crear</a>

    <?php endif ?>

    <?php if($this->uri->segment(2)  == '' AND $rol == 1): ?>

        <button data-uri="<?= site_url('registros/soft_delete') ?>" title="Limpiar resgistros " style="float: right;" class="btn btn-danger delete-soft" type="button"><i class="fa fa-trash-o" aria-hidden="true"></i> Limpiar resgistros</button>

        <a href="<?= base_url('assets/csv/registros.csv') ?>" title="Descarga la plantilla CSV" style="float: right;" class="btn grey-mint" type="button"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Plantilla CSV</a>

        <button title="Asignar registros de un operario a otro" style="float: right;" class="btn btn-info" data-toggle="modal" data-target="#reasignarModal" type="button"><i class="fa fa-retweet" aria-hidden="true"></i> Reasignar</button>

        <button title="Subir lote de registros" style="float: right;" class="btn yellow" data-toggle="modal" data-target="#registrosModal" type="button"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Registros</button>

    <?php endif ?>

    <?php if($this->uri->segment(2)  == '' AND $rol == 4): ?>
        
       <a style="float: right;" href="<?= site_url($path.'/startCalls') ?>" class="btn blue" type="button"><i class=" icon-call-end "></i> Comenzar</a>

        <a href="<?= base_url('assets/csv/registros.csv') ?>" title="Descarga la plantilla CSV" style="float: right;" class="btn grey-mint" type="button"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Plantilla CSV</a>

        <button title="Subir lote de registros" style="float: right;" class="btn yellow" data-toggle="modal" data-target="#registrosModal" type="button"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Registros</button>
     
    <?php endif ?>

    <?php if($this->uri->segment(2)  == 'view' AND $rol == 4): ?>

        <a id="0" data-campaign="<?= $getRegistro->getCampaign()->getId() ?>" target="_blank" data-toggle="modal" data-target="#modalArgumentario" class="btn green argumentario" type="button"><i class="fa fa-bullhorn"></i> Argumentario</a>
        <a style="display:none;" id="0" data-campaign="<?= $getRegistro->getCampaign()->getId() ?>" target="_blank" data-toggle="modal" data-target="#modalSendInfo" class="btn green template send-template" type="button"><i class="fa fa-envelope-o"></i> Enviar info</a>

    <?php endif ?>

</div>
