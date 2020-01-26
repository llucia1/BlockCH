<div class="modal fade" id="volverLlamarModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Volver a llamar</h4>

            </div>

            <div class="modal-body">

                <form id="formendcall" action="<?= site_url('tareas/volverLlamar/'.$id) ?>" method="post">

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

                            <label>Hora</label>

                            <div class="input-group">

                                <input name="hour" value="<?= date("H:i:s") ?>" type="text" class="form-control timepicker timepicker-24">

                                <span class="input-group-btn">

                                    <button class="btn default" type="button">

                                        <i class="fa fa-clock-o"></i>

                                    </button>

                                </span>

                            </div>

                        </div>

                    </div>

                    <div class="form-group">

                        <label>Comentario</label>

                        <textarea class="form-control" rows="3" value="" name="comentario"></textarea>

                    </div>

                    <div class="form-group">

                        <button name="submit-data" class="btn green" type="submit">Guardar</button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>