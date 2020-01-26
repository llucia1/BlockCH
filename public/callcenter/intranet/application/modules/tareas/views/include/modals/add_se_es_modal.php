<div class="modal fade" id="AddSeEsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Asignar fecha y hora</h4>

            </div>

            <div class="modal-body">

                <form action="<?= site_url('tareas/edit/'.$id) ?>" enctype="multipart/form-data" method="post">

                    <input type="hidden" name="tipo-seguimiento" value="">

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

                        <label>Comentario</label>

                        <textarea class="form-control" rows="3" value="" name="comentario"></textarea>

                    </div>

                    <div class="form-group">

                        <button name="submit-AddSeEsModal" class="btn green" type="submit">Asignar</button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>