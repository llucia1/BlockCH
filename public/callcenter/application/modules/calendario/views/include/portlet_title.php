<div class="portlet-title">
	
	<!-- MODIFICADO: se ha quitado de la condicion if "AND $rol != 3" -->	
    <?php if($this->uri->segment(3) != 'add'): ?>
        <a href="#" class="btn green" data-toggle="modal" data-target="#eventosModal" type="button"><i class=" icon-plus "></i> Evento</a>
    <?php endif ?>

</div>
