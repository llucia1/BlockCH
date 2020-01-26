<div class="portlet-title">

    <?php if($this->uri->segment(2) != 'add'): ?>

        <a href="<?= site_url($path.'/add/') ?>" class="btn green" type="button"><i class=" icon-plus "></i> Crear</a> 

    <?php endif ?>

    <?php if($this->uri->segment(2) == '' AND $rol == 1): ?>

    	<a style="float: right;" href="<?= site_url($path.'/truncate') ?>" class="btn red" type="button"><i class="fa fa-file-excel-o" aria-hidden="true"></i></i> Borrar datos</a>

    	<a style="float: right;" href="<?= site_url($path.'/export/1') ?>" class="btn grey-mint" type="button"><i class="fa fa-file-excel-o" aria-hidden="true"></i></i> Exportar</a>

    	<a style="float: right;" href="<?= site_url($path.'/export/2') ?>" class="btn yellow" type="button"><i class="fa fa-file-excel-o" aria-hidden="true"></i></i> Estadística</a>

    <?php endif ?>

</div>
