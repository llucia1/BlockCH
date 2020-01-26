
<div class="portlet light bordered">

    <?= validation_errors(); ?>

    <div class="portlet-title">

        <h3>Detalles de Cliente</h3>

    </div>


    <div class="portlet-body flip-scroll">

        <div class="row">

            <div class="col-md-6 col">

                <div class="form-body">

                    <div class="form-group">

                        <label><span style="color:red">*</span> Razón social</label>

                        <div class="input-group">

                            <span class="input-group-addon">

                                <i class="fa fa-pencil"></i>

                            </span>

                            <input name="nombre" value="<?= set_value('nombre'); ?>" class="form-control" type="text">

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

                            <input name="telefono" value="<?= set_value('telefono'); ?>" class="form-control" type="text">

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

                            <input name="telefonoAlt" value="<?= set_value('telefonoAlt'); ?>" class="form-control" type="text">

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

                            <input name="email" value="<?= set_value('email'); ?>" class="form-control" type="text">

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

                            <input name="cif" value="<?= set_value('cif'); ?>" class="form-control" type="text">

                        </div>

                    </div>

                </div>

            </div>

            <div class="col-md-6">

                <div class="form-body">

                    <div class="form-group">

                        <label><span style="color:red">*</span>Asignado a</label>
  
                        <select name="idUsuario" class="form-control">

                            <option value=""></option>

                            <?php foreach($getUsuarios as $usuario): ?>

                                <option value="<?= $usuario->getId() ?>"><?= $usuario->getNombre() ?> <?= $usuario->getApellidos() ?></option>

                            <?php endforeach ?>

                        </select>

                    </div>

                </div>

            </div>
            
            <div class="col-md-6">

                <div class="form-body">

                    <div class="form-group">

                        <label>Convertido Pre Contrato</label>
  
                        <select name="convertidoPre" class="form-control">

                            <option value="0">NO</option>
                            <option value="1">SI</option>

                        </select>

                    </div>

                </div>

            </div>

            <div class="col-md-6">

                <div class="form-body">

                    <div class="form-group">

                        <label>Notificar Propietario</label>
  
                        <select name="notiPro" class="form-control">

                            <option value="0">NO</option>
                            <option value="1">SI</option>

                        </select>

                    </div>

                </div>

            </div>

            <div class="col-md-12">

                <div class="form-body">

                    <div class="form-group">

                        <label>Persona de Contacto</label>

                        <div class="input-group">

                            <span class="input-group-addon">

                                <i class="fa fa-pencil"></i>

                            </span>

                            <input name="personaCnt" value="<?= set_value('personaCnt'); ?>" class="form-control" type="text">

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

                            <input name="direccion" value="<?= set_value('direccion'); ?>" class="form-control" type="text">

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

                            <input name="poblacion" value="<?= set_value('poblacion'); ?>" class="form-control" type="text">

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

                            <input name="provincia" value="<?= set_value('provincia'); ?>" class="form-control" type="text">

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

                            <input name="cp" value="<?= set_value('cp'); ?>" class="form-control" type="text">

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

