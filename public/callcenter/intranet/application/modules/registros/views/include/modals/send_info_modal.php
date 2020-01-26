<div class="modal fade" id="modalSendInfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Enviar información</h4>

            </div>

            <div class="modal-body">

                <div class="form-group">

                    <label>Selecciona una plantilla</label>

                    <div class="input-group col-md-12">

                        <select  name="templates" class="form-control info-templates">

                            <option value="0"></option>
                            <?php foreach ($getTemplates as $key => $template): ?>
                                <option value="<?= $template->getId() ?>"><?= $template->getTitle() ?></option>
                            <?php endforeach ?>

                        </select>

                    </div>

                </div>

                <div style="display:none;" class="alert alert-danger" role="alert">Tienes que seleccionar una plantilla.</div>
                <div style="display:none;" class="alert alert-success" role="alert"></div>
                <div style="display:none;" class="alert alert-info" role="alert"></div>

                <div class="form-group">

                    <button name="send-info-template" class="btn green send-info-template"  type="button">Enviar</button>

                </div>
               
            </div>

        </div>

    </div>

</div>