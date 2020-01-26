<div class="portlet-title">

    <h3>Acciones</h3>

</div>

<?php if(in_array($getCuSegui->getTipo(),$showSiNo)): ?>

<div class="form-group">

    <label>SI/NO</label>
    
    <select data-tarea="<?= $getRow->getId()?>" data-seguimiento="<?= $getCuSegui->getId()?>" name="realizado" class="form-control verifica-tarea">
        
        <option value="">Selecciona sólo en caso positivo</option>
        <option value="1">SI</option>

    </select>

</div>

<?php endif ?>

<?php if(in_array($getCuSegui->getTipo(),$showNuevo)): ?>

<div class="form-group">

    <label>Nuevo</label>
    
    <select <?php if($getCuSegui->getTipo() == 'Documentación') echo 'disabled' ?>  data-id="<?= $id ?>"  name="realizado" class="form-control add-se-es">
        
        <option value="">Selecciona Nuevo</option>

        <option <?php if($getCuSegui->getTipo() >= 'Nuevo 1') echo 'disabled' ?> value="Nuevo 1">Nuevo 1</option>
        <option <?php if($getCuSegui->getTipo() >= 'Nuevo 2') echo 'disabled' ?> value="Nuevo 2">Nuevo 2</option>
        <option <?php if($getCuSegui->getTipo() >= 'Nuevo 3') echo 'disabled' ?> value="Nuevo 3">Nuevo 3</option>

    </select>

</div>

<?php endif ?>

<?php if(in_array($getCuSegui->getTipo(),$showOferta)): ?>

<div class="form-group">

    <label>Oferta</label>
    
    <select data-id="<?= $id ?>" name="realizado" class="form-control add-se-es">
        
        <option value="">Selecciona Oferta</option>

        <option <?php if($getCuSegui->getTipo() >= 'Oferta 1') echo 'disabled' ?> value="Oferta 1">Oferta 1</option>
        <option <?php if($getCuSegui->getTipo() >= 'Oferta 2') echo 'disabled' ?> value="Oferta 2">Oferta 2</option>
        <option <?php if($getCuSegui->getTipo() >= 'Oferta 3') echo 'disabled' ?> value="Oferta 3">Oferta 3</option>

    </select>

</div>

<?php endif ?>

<div class="form-group">

    <?= $this->load->view('templates/panel/include/form_ko') ?>

</div>

<div class="form-group ">

    <form name="form-close-tarea" action="<?= site_url('tareas/close_tarea/'.$id) ?>" method="post">
        
        <input type="hidden" name="closeTarea">

    </form>

    <!--<button id="close-tarea" style="width: 100%;" class="btn green send-form" type="button">Cerrar tarea</button>-->

</div>
