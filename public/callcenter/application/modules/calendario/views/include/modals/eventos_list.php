<div class="modal fade" id="eventoslistModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"></h4>

            </div>

            <div class="modal-body">

                <div id="table-calendar">
                    
                </div>

                <div style="display: none;" id="form-edit">
                    
                    <form id="" action="#">

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

                            <label>Asignar evento a</label>

                            <select name="usuario" class="form-control">

                                <?php foreach($users as $user): ?>

                                    <?php if($rol == 7): ?>

                                    <option value="<?= $user->getIdusuario()->getId() ?>"><?= $user->getIdusuario()->getNombre() ?> <?= $user->getIdusuario()->getApellidos() ?></option>

                                    <?php else: ?>

                                        <option value="<?= $user->getId() ?>"><?= $user->getNombre() ?> <?= $user->getApellidos() ?></option>

                                    <?php endif ?>       

                                <?php endforeach ?>

                            </select>

                        </div>

                        <div class="form-group">

                            <label>Comentarios</label>
                            <textarea name="commentEvent" class="form-control" rows="3"></textarea>

                        </div>

                        <div class="form-group">

                            <button name="edit-submit" class="btn green" type="button">Guardar</button>

                        </div>

                    </form>
                    
                </div>

            </div>

        </div>

    </div>

</div>