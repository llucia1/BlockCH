<div class="modal fade" id="reasignarModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Reasignar registros</h4>

            </div>

            <div class="modal-body">

                <form action="<?= site_url('registros/reasign_registers') ?>"  method="post">

                    <div class="form-body">

                         <div class="form-group">

                            <label>Provincia</label>

                            <input name="provincia" class="form-control provincia" placeholder="" type="text">

                        </div>

                        <div class="form-group">

                            <label>Población</label>

                            <input name="poblacion" class="form-control poblacion" placeholder="" type="text">

                        </div>

                        <div class="form-group">

                            <label>CP</label>

                            <input name="cp" class="form-control cp" placeholder="" type="text">

                        </div>

                        <div class="form-group">

                            <label>Estado</label>

                            <select name="estadoReg" class="form-control estadoReg">

                                <option value="0">Selecciona un estado</option>

                                <?php foreach($getEstadosregistros as $estado): ?>

                                    <option value="<?= $estado->getId() ?>"><?= $estado->getNombre() ?></option>

                                <?php endforeach ?>

                            </select>

                        </div>

                        <div style="display: none;" class="form-group actionestadoReg">

                            <label class="mt-radio mt-radio-outline">
                                <input name="type" id="typeCon" type="radio" value="1"> Todos menos el seleccionado
                                <span></span>
                            </label>

                            <label class="mt-radio mt-radio-outline">
                                <input name="type" id="typeCon" type="radio" value="2"> El seleccionado
                                <span></span>
                            </label>

                        </div>

                        <div class="form-group">

                            <label>Usuario</label>

                            <select name="usuarioReg" class="form-control usuarioReg">

                                <option value="0">Selecciona un usuario con registros</option>

                                <?php foreach($getUsuarios as $usuario): ?>

                                    <option value="<?= $usuario->getId() ?>"><?= $usuario->getNombre() ?> <?= $usuario->getApellidos() ?></option>

                                <?php endforeach ?>

                            </select>

                            <div class="clearfix margin-top-10 note">



                            </div>

                        </div>

                        <div class="form-group">

                            <label>Registros</label>

                            <input name="limit" value="" class="form-control" placeholder="Indica cuantos registros quieres reasignar al nuevo usuario." type="text">

                        </div>

                        <div class="form-group">

                            <label>Asignar a</label>

                            <select name="reasignar" class="form-control">

                                <option value="0">Selecciona un usuario para reasignar</option>

                                <?php foreach($getUsuarios as $usuario): ?>

                                    <option value="<?= $usuario->getId() ?>"><?= $usuario->getNombre() ?> <?= $usuario->getApellidos() ?></option>

                                <?php endforeach ?>

                            </select>

                        </div>

                        <div id="date-hour">

                        <div class="form-group">

                            <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-week-start="1" data-date-language="es">

                                <input name="date" value="<?= date('d-m-Y') ?>" type="text" class="form-control" readonly>

                                <span class="input-group-btn">

                                    <button class="btn default" type="button">

                                        <i class="fa fa-calendar"></i>

                                    </button>

                                </span>

                            </div>

                        </div>

                        <div class="form-group">

                            <button name="submit" class="btn green" type="submit">Guardar</button>

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>