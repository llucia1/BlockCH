<div class="tab-pane fade" id="Agendar">
    
    <div class="row">

        <div class="portlet light">

          
            <div class="portlet-title">

                <h3>Agendar</h3>

            </div>

            <div class="portlet-body flip-scroll">

                <div class="row">

                    <div class="col-md-12">

                         <form id="form-agendar" action="<?= site_url('clientes/setAgendar/'.$id) ?>" method="post">

                            <div class="form-group">

                                <label><span style="color:red">*</span>Estado seguimiento</label>
                                
                                <select name="estado" class="form-control agendarRequired estadoSeguimiento">
                                    
                                    <option value="">Selecciona un estado</option>
                                    <option value="Nuevo 1">Nuevo 1</option>
                                    <option value="Nuevo 2">Nuevo 2</option>
                                    <option value="Nuevo 3">Nuevo 3</option>
                                    <option value="Oferta 1">Oferta 1</option>
                                    <option value="Oferta 2">Oferta 2</option>
                                    <option value="Oferta 3">Oferta 3</option>
                                    <option value="Cierre">Cierre</option>
                                    <option value="Firmado">Firmado</option>
                                    <option value="Ko">Ko</option>

                                </select>

                            </div>

                            <div style="display: none;" class="form-group agendarKO">
								
								<input name="goBackTo" id="goBackTo" type="hidden" value="clientes/edit/<?= $id ?>" />

							    <?= $this->load->view('templates/panel/include/form_ko') ?>

							</div>

                            <div style="display: none;" class="form-group agendarSiNo">

                                <label>¿Quieres agendar?</label>
                                
                                <select id="agendar" name="agendarSiNo" class="form-control boSelect">
                                    
                                    <option value="0">NO</option>
                                    <option value="1">SI</option>

                                </select>

                            </div>

                            <div style="display: none;" class="form-group boShHi-agendar">

                                <label>Agendar como</label>
                                
                                <select name="agendarTipo" class="form-control">
                                    
                                    <option value="E.O.Modi">E.O.Modi</option>
							        <option value="Cierre">Cita cierre</option>

                                </select>

                            </div>

                            <div class="content-agendar">

	                            <div class="form-group">

	                                <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-week-start="1" data-date-language="es">

	                                    <input name="fEvent" value="<?= date('d-m-Y') ?>" type="text" class="form-control" readonly>

	                                    <span class="input-group-btn">

	                                        <button class="btn default" type="button">

	                                            <i class="fa fa-calendar"></i>

	                                        </button>

	                                    </span>

	                                </div>

	                            </div>

	                            <div class="form-group">

	                                <label>Hora</label>

	                                <div class="input-group">

	                                    <input name="hEvent" value="<?= date("H:i:s") ?>" type="text" class="form-control timepicker timepicker-24">

	                                    <span class="input-group-btn">

	                                        <button class="btn default" type="button">

	                                            <i class="fa fa-clock-o"></i>

	                                        </button>

	                                    </span>

	                                </div>

	                            </div>

	                            <div class="form-group">

	                                <label><span style="color:red"></span>Asignar Teleoperador</label>
	                                
	                                <select name="toperador" class="form-control agendarRequired">
	                                    
	                                    <option value="">Selecciona un Teleoperador</option>

	                                    <?php foreach ($getToperadores as $key => $toperador): ?>
	                                        
	                                        <option <?php if($getRow->getIdusuario()->getId() == $toperador->getId()) echo 'selected' ?> value="<?= $toperador->getId() ?>"><?= $toperador->getNombre() ?> <?= $toperador->getApellidos() ?></option>

	                                    <?php endforeach ?>


	                                </select>

	                            </div>

	                            <div class="form-group">

	                                <label><span style="color:red"></span>Asignar Comercial</label>
	                                
	                                <select name="comercial" class="form-control agendarRequired">
	                                    
	                                    <option value="">Selecciona un Comercial</option>

	                                    <?php foreach ($getComerciales as $key => $comercial): ?>
	                                        
	                                        <option <?php if($getRow->getIdcomercial() == $comercial->getId()) echo 'selected' ?> value="<?= $comercial->getId() ?>"><?= $comercial->getNombre() ?> <?= $comercial->getApellidos() ?></option>

	                                    <?php endforeach ?>


	                                </select>

	                            </div>

	                            <div class="form-body">

	                                <div class="form-group">

	                                    <label><span style="color:red">*</span>Comentario</label>

	                                    <textarea name="comentario" class="form-control agendarRequired"></textarea>

	                                </div>

	                            </div>

	                            <div class="form-group">

	                                <button name="submit" id="agendar" class="btn green checkRequired" type="submit">Agendar</button>

	                            </div>

                            </div>

                         </form>

                     </div>

                </div>

            </div>  
           

        </div>

    </div>

</div>