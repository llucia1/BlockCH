<div class="modal fade" id="AttachModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Adjuntar Documento</h4>

            </div>

            <div class="modal-body">

                <form action="<?= site_url($pathModal) ?>" enctype="multipart/form-data" method="post">

                    <div class="form-group">

                        <label>Tipo de documento</label>
                        
                        <select name="tipo-documento" class="form-control">
                            
                            <option value="">Selecciona Tipo documento</option>
                            
                            <?php foreach ($getTiposDocumentos as $key => $tipo): ?>

                                <option value="<?= $tipo->getValor() ?>"> <?= $tipo->getValor() ?></option>
                                
                            <?php endforeach ?>

                        </select>

                    </div>

                    <div class="form-group">

                        <label>Documento</label>

                        <div class="input-group col-md-12">

                            <input name="nombreDocumento" value="" class="form-control" type="text">

                        </div>

                    </div>

                    <div class="form-group">

                        <label>Documento</label>

                        <div class="input-group">

                            <input name="file" id="file" type="file">

                        </div>

                        <div class="clearfix margin-top-10">

                            <span class="label label-danger">NOTA!</span> El archivo no puede tener un peso superior a 2MB.

                        </div>

                    </div>

                    <div class="form-group">

                        <button name="submit-attach" class="btn green" type="submit">Guardar</button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>