<div class="modal fade" id="registrosllamadasModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Finalizar llamada</h4>

            </div>

            <div class="modal-body">

                <form id="formendcall" action="<?= site_url('registros/edit_record') ?>" method="post">

                    <div class="form-group">

                        <label>Estado</label>

                        <select data-id="<?= $id ?>" id="estados" name="estados" class="form-control">

                            <?php foreach($getEstadosregistros as $estadoRegistro): ?>

                                <option value="<?= $estadoRegistro->getId() ?>"><?= $estadoRegistro->getNombre() ?></option>

                            <?php endforeach ?>

                        </select>

                    </div>

                    <div id="reason" style="display: none;">

                        <div class="form-group">

                            <label>Motivo</label>

                            <select data-id="<?= $id ?>" id="reasons" name="reason" class="form-control">

                                <?php foreach($getReasons as $reason): ?>

                                    <option value="<?= $reason->getName() ?>"><?= $reason->getName() ?></option>

                                <?php endforeach ?>

                            </select>

                        </div>

                    </div>

                    <div id="date-hour">

                        <div class="form-group">

                            <label>Fecha nueva llamada</label>

                            <div class="input-group input-medium date date-picker" data-date-format="dd/mm/yyyy" data-date-week-start="1" data-date-language="es">

                                <input name="date" value="<?= date('d/m/Y') ?>" type="text" class="form-control" readonly>

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

                                <input name="hour" value="<?= date("H:i:s",$getNewHour) ?>" type="text" class="form-control timepicker timepicker-24">

                                <span class="input-group-btn">

                                    <button class="btn default" type="button">

                                        <i class="fa fa-clock-o"></i>

                                    </button>

                                </span>

                            </div>

                        </div>

                    </div>

                    <div id="addEvent" style="display: none;">
                        
                        <?= $this->load->view('add_event') ?>

                    </div>

                    <div class="form-group">

                        <label>Comentario</label>

                        <textarea class="form-control" rows="3" value="" name="comentario"></textarea>

                    </div>

                    <div class="form-group">

                        <button name="submit" class="btn green" type="submit">Guardar</button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>