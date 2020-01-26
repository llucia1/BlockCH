<div class="modal fade" id="registrosModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Subir lote de registros</h4>

            </div>

            <div class="modal-body">

                <form action="<?= site_url('registros/upload_registers') ?>" enctype="multipart/form-data" method="post">

                    <div class="form-group">

                        <label>Listado</label>

                        <div class="input-group">

                            <input name="file" id="file" type="file">

                        </div>

                        <div class="clearfix margin-top-10">

                            <span class="label label-danger">NOTA!</span> El formato del archivo tiene que ser .CSV separado por ';' y con un peso máximo de 2MB.

                        </div>

                    </div>

                    <div class="form-group">

                        <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-week-start="1" data-date-language="es">

                            <input name="fRegistro" value="<?= date('d-m-Y') ?>" type="text" class="form-control" readonly>

                            <span class="input-group-btn">

                                <button class="btn default" type="button">

                                    <i class="fa fa-calendar"></i>

                                </button>

                            </span>

                        </div>

                    </div>

                    <div class="form-group">

                        <label>Operario</label>

                        <select name="usuario" class="form-control">

                            <?php foreach($getUsuarios as $usuario): ?>

                                <option value="<?= $usuario->getId() ?>"><?= $usuario->getNombre() ?> <?= $usuario->getApellidos() ?></option>

                            <?php endforeach ?>

                        </select>

                    </div>

                    <div class="form-group">

                        <button name="submit" class="btn green" type="submit">Guardar</button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>