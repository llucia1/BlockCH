<div id="documentacion">
    
    <div class="row">

        <div class="portlet light">

            <div class="portlet-title">
                
                <div class="col-md-6">

                    <h3>Documentación adjunta</h3>

                </div>
                
                <?php if($getRow->getIdusuarioto()->getIdrol()->getId() == 3): ?>

                    <a style="float: right; margin-top: 15px;" href="#" class="btn green" data-toggle="modal" data-target="#AttachModal"><i class=" icon-plus "></i> Adjuntar documento</a>

                <?php endif ?>

            </div>

            <div class="portlet-body flip-scroll">

                <div class="row">

                    <div class="col-md-12">

                        <div class="form-body">
                            
                            <?php if($attachments): ?>

                                <table class="table table-bordered table-striped table-condensed flip-content">

                                    <thead class="flip-content">

                                    <tr>
                                        <?php foreach ($thead as $th): ?>

                                            <?php if($th == 'Estado'): ?>

                                                <th width="4%"> <?= $th ?> </th>
                                            
                                            <?php else: ?>

                                                <th width="20%"> <?= $th ?> </th>

                                            <?php endif ?>
                                            
                                        <?php endforeach ?>
                                        <th width="20%">Acciones</th>
                                    </tr>

                                    </thead>

                                    <tbody>

                                        <?php foreach ($attachments as $result): ?>

                                            <tr>
                                            
                                                <td> <?= $result->getId() ?> </td>
                                                <td> <?= $result->getNombredocumento() ?> </td>
                                                <td> <?= $result->getAttached() ?> </td>
                                                <td> <?= $result->getFalta()->format('d-m-Y') ?> </td>
                                                <td>

                                                    <label class="mt-checkbox-outline">
                                                        <input <?php if($getRow->getIdusuarioto()->getIdrol()->getId() == 3) echo 'disabled' ?> <?php if($result->getEstado() == 1) echo 'checked'; ?> value="<?= $result->getEstado() ?>" class="md-check" multi="false" table="attachments" field="estado" key="<?= $result->getId() ?>" type="checkbox">
                                                            
                                                        <span></span>
                                                    </label>

                                                </td>
                                                <td>

                                                    <a target="blank" title="Ver" href="<?= base_url('assets/attachments_cuentas/'.$result->getAttached()) ?>" class="btn yellow" type="button"><i class="icon-eye"></i></a>
                                                    
                                                </td>

                                            </tr>

                                        <?php endforeach ?>

                                    </tbody>

                                </table>

                            <?php else: ?>

                                <div class="alert alert-warning" role="alert">Esta cuenta no tiene documentación adjunta.</div>

                            <?php endif ?>

                        </div>

                        <div class="form-group ">

                            <form name="form-close-tarea" action="<?= site_url('tareas/close_tarea/'.$id) ?>" method="post">

                                <input type="hidden" name="closeTarea">
                                <input type="hidden" name="documentacion">

                                 <button id="close-tarea" class="btn green send-form" type="submit">Cerrar tarea</button>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>