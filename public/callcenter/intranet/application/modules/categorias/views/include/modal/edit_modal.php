<div aria-hidden="true" role="basic" tabindex="-1" id="editModal<?= $id ?>" class="modal fade" style="display: none;">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <h4 style="float:left" class="modal-title">Editar categoría <?= $category ?></h4>

            </div>

            <div class="modal-body">

              <form role="form">

                <div class="form-group">

                    <label>Nombre</label>

                    <div class="input-group">

                        <span class="input-group-addon">

                            <i class="fa fa-pencil"></i>

                        </span>

                        <input name="name" type="text" placeholder="Nombre de la página" value="<?= $category ?>" key="<?= $id ?>" class="form-control md-text" table="categorias" field="name">

                	</div>

                </div>

                <div class="form-group form-md-checkboxes">

    									<div class="md-checkbox-inline">

    											<div class="md-checkbox">

    													<input <?php if($state == 1) echo 'checked' ?> type="checkbox" class="md-check" id="Publicar" multi="false" key="<?= $id ?>" table="categorias" field="state">

    													<label for="Publicar">
    															<span class="inc"></span>
    															<span class="check"></span>
    															<span class="box"></span> Activar</label>
    											</div>

    									</div>

    							</div>

                  <div class="form-group">

                      <label>Orden</label>

                      <div class="input-group">

                          <span class="input-group-addon">

                              <i class="fa fa-pencil"></i>

                          </span>

                          <input name="orden" type="text" value="<?= $orden ?>" key="<?= $id ?>" class="form-control md-text" table="categorias" field="orden">

                  	</div>

                  </div>

                <div class="form-actions">

                    <div class="row">

                        <div class="col-md-12">

                            <button onclick="location.reload(true);" class="btn dark" type="button"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>

                        </div>

                    </div>

                </div>

              </form>

           	</div>

            <div class="modal-footer">

                <button data-dismiss="modal" class="btn dark btn-outline" type="button">Cerrar</button>

            </div>

        </div>

    </div>

</div>
