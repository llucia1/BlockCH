<div class="tab-pane fade" id="documentacion">
    
    <div class="row">

        <div class="portlet light">

            <div class="portlet-title">
                
                <div class="col-md-6">

                    <h3>Documentación adjunta</h3>

                </div>
                

                <a style="float: right; margin-top: 15px;" href="#" class="btn green" data-toggle="modal" data-target="#AttachModal"><i class=" icon-plus "></i> Adjuntar documento</a>

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

                                            <?php if($th == 'Estado' OR $th == 'ID'): ?>

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
                                                <td> <?= $result->getTipodocumento() ?> </td>
                                                <td> <?= $result->getAttached() ?> </td>
                                                <td> <?= $result->getFalta()->format('d-m-Y') ?> </td>
                                                <td>

                                                    <label class="mt-checkbox mt-checkbox-outline">
                                                        <input <?php if($result->getEstado() == 1) echo 'checked'; ?> value="<?= $result->getEstado() ?>" class="md-check" multi="false" table="attachments" field="estado" key="<?= $result->getId() ?>" type="checkbox">
                                                            
                                                        <span></span>
                                                    </label>

                                                </td>
                                                <td>
                                                    <a target="blank" title="Ver" href="<?= base_url('assets/attachments_cuentas/'.$result->getAttached()) ?>" class="btn yellow" type="button"><i class="icon-eye"></i></a>
                                                    <a title="Eliminar" href="<?= site_url($path.'/delete-att/'.$result->getId().'/'.$id) ?>" class="btn red" type="button"><i class="icon-trash "></i></a>
                                                </td>

                                            </tr>

                                        <?php endforeach ?>

                                    </tbody>

                                </table>

                            <?php else: ?>

                                <div class="alert alert-warning" role="alert">Esta cuenta no tiene documentación adjunta.</div>

                            <?php endif ?>

                        </div>

                    </div>

                </div>

            </div>

    </div>

</div>

        </div>