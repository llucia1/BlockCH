<div class="portlet-title">
	
	<?php if($getRow->getTipo() == 'cobertura'): ?>

    	<h3>Comprobar cobertura</h3>

    <?php else: ?>
		
		<h3>Acciones</h3>

	<?php endif ?>

</div>

<?php if($getRow->getTipo() != 'cobertura'): ?>

<div class="form-group">

    <label>Seguimiento Oferta</label>
    
    <select data-tarea="<?= $getRow->getId()?>" data-seguimiento="<?= $getCuSegui->getId()?>" name="realizado" class="form-control select-cierre">
        
        <option value="">Selecciona una opción</option>
        <option value="E.O.Modi">E.O.Modi</option>
        <option value="Volver a llamar">Volver a llamar</option>
        <option value="Cierre">Cita cierre</option>

    </select>

</div>

<?php endif ?>

<div class="form-group">

	<?php if($getRow->getTipo() == 'cobertura'): ?>

		<?= $this->load->view('include/form_cobertura') ?>

	<?php else: ?>
		
		<?= $this->load->view('templates/panel/include/form_ko') ?>

	<?php endif ?>

</div>

<?= $this->load->view('include/modals/volverLlamar_modal') ?>