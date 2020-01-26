<div class="tab-pane fade active in" id="detalleCliente">
    
    <div class="row">

	    
		<div class="portlet light">

		    <?= validation_errors(); ?>

		    <div class="portlet-title">

		        <h3>Detalles de Cliente</h3>

		    </div>

		    <form enctype="multipart/form-data" role="form" method="post">

			    <div class="portlet-body flip-scroll">

			        <div class="row">

			            <div class="col-md-6">

			                <div class="form-body">

			                    <div class="form-group">

			                        <label><span style="color:red">*</span> Nombre de Cuenta</label>

			                        <div class="input-group">

			                            <span class="input-group-addon">

			                                <i class="fa fa-pencil"></i>

			                            </span>

			                            <input name="nombre" value="<?= $getRow->getNombre() ?>" class="form-control" type="text">

			                        </div>

			                    </div>

			                </div>

			            </div>

			            <div class="col-md-6">

			                <div class="form-body">

			                    <div class="form-group">

			                        <label><span style="color:red">*</span> CIF</label>

			                        <div class="input-group">

			                            <span class="input-group-addon">

			                                <i class="fa fa-pencil"></i>

			                            </span>

			                            <input name="cif" value="<?= $getRow->getCif() ?>" class="form-control" type="text">

			                        </div>

			                    </div>

			                </div>

			            </div>

			            <div class="col-md-6">

			                <div class="form-body">

			                    <div class="form-group">

			                        <label>Teléfono</label>

			                        <div class="input-group">

			                            <span class="input-group-addon">

			                                <i class="fa fa-pencil"></i>

			                            </span>

			                            <input name="telefono" value="<?php if($getRow->getTelefono() !=0) echo $getRow->getTelefono() ?>" class="form-control" type="text">

			                        </div>

			                    </div>

			                </div>

			            </div>

			            <div class="col-md-6">

			                <div class="form-body">

			                    <div class="form-group">

			                        <label>Teléfono alternativo</label>

			                        <div class="input-group">

			                            <span class="input-group-addon">

			                                <i class="fa fa-pencil"></i>

			                            </span>

			                            <input name="telefonoAlt" value="<?php if($getRow->getTelefonoalt() !=0) echo $getRow->getTelefonoalt() ?>" class="form-control" type="text">

			                                
			                        </div>

			                    </div>

			                </div>

			            </div>

			            <div class="col-md-6">

			                <div class="form-body">

			                    <div class="form-group">

			                        <label>Persona de contacto</label>

			                        <div class="input-group">

			                            <span class="input-group-addon">

			                                <i class="fa fa-pencil"></i>

			                            </span>

			                            <input name="personaCnt" value="<?= $getRow->getPersonacnt() ?>" class="form-control" type="text">

			                        </div>

			                    </div>

			                </div>

			            </div>

			            <div class="col-md-6">

			                <div class="form-body">

			                    <div class="form-group">

			                        <label>Email</label>

			                        <div class="input-group">

			                            <span class="input-group-addon">

			                                <i class="fa fa-pencil"></i>

			                            </span>

			                            <input name="email" value="<?= $getRow->getEmail() ?>" class="form-control" type="text">

			                        </div>

			                    </div>

			                </div>

			            </div>

			            <div class="col-md-6">

			                <div class="form-body">

			                    <div class="form-group">

			                        <label>Dirección</label>

			                        <div class="input-group">

			                            <span class="input-group-addon">

			                                <i class="fa fa-pencil"></i>

			                            </span>

			                            <input name="direccion" value="<?= $getRow->getDireccion() ?>" class="form-control" type="text">

			                        </div>

			                    </div>

			                </div>

			            </div>

			            <div class="col-md-6">

			                <div class="form-body">

			                    <div class="form-group">

			                        <label>Código Postal</label>

			                        <div class="input-group">

			                            <span class="input-group-addon">

			                                <i class="fa fa-pencil"></i>

			                            </span>

			                            <input name="cp" value="<?php if($getRow->getCp() !=0) echo $getRow->getCp() ?>" class="form-control" type="text">

			                        </div>

			                    </div>

			                </div>

			            </div>

			            <div class="col-md-6">

			                <div class="form-body">

			                    <div class="form-group">

			                        <label>Población</label>

			                        <div class="input-group">

			                            <span class="input-group-addon">

			                                <i class="fa fa-pencil"></i>

			                            </span>

			                            <input name="poblacion" value="<?= $getRow->getPoblacion() ?>" class="form-control" type="text">

			                        </div>

			                    </div>

			                </div>

			            </div>

			            <div class="col-md-6">

			                <div class="form-body">

			                    <div class="form-group">

			                        <label>Provicia</label>

			                        <div class="input-group">

			                            <span class="input-group-addon">

			                                <i class="fa fa-pencil"></i>

			                            </span>

			                            <input name="provincia" value="<?= $getRow->getProvincia() ?>" class="form-control" type="text">

			                        </div>

			                    </div>

			                </div>

			            </div>

			            <div class="col-md-6">

			                <div class="form-body">

			                    <div class="form-group">

			                        <label><span style="color:red">*</span>Teleoperador</label>
			  
			                        <select name="idUsuario" class="form-control">

			                            <?php foreach($usuarios as $usuario): ?>
			                                
			                                <option <?php if($getRow->getIdusuario()->getId() == $usuario->getId()) echo 'selected' ?> value="<?= $usuario->getId() ?>" ><?= $usuario->getNombre() ?> <?= $usuario->getApellidos() ?></option>

			                            <?php endforeach ?>

			                        </select>

			                    </div>

			                </div>

			            </div>

			            <div class="col-md-6">

			                <div class="form-body">

			                    <div class="form-group">

			                        <label><span style="color:red">*</span>Comercial</label>
			  
			                        <select name="idComercial" class="form-control">

			                            <?php foreach($getComerciales as $comercial): ?>
			                                
			                                <option <?php if($getRow->getIdcomercial() == $comercial->getId()) echo 'selected' ?> value="<?= $comercial->getId() ?>" ><?= $comercial->getNombre() ?> <?= $comercial->getApellidos() ?></option>

			                            <?php endforeach ?>

			                        </select>

			                    </div>

			                </div>

			            </div>

			            <div class="col-md-12">

				            <div class="form-body">

			                    <div class="form-group">

			                        <label>Descripción</label>

			                        <textarea name="descripcion" class="form-control"><?= $getRow->getDescripcion(); ?></textarea>

			                    </div>

			                </div>

			             </div>

			             <div class="col-md-12">

				            <div class="form-group">

			                    <button name="submit" class="btn green" type="submit">Guardar</button>

			                </div>

			            </div>

			        </div>

			    </div>

		    </form>

		</div>


    </div>

</div>