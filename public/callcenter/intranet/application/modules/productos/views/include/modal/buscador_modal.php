<div aria-hidden="true" role="basic" tabindex="-1" id="buscadorModal" class="modal fade" style="display: none;">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <h4 style="float:left" class="modal-title"><i class="fa fa-search" aria-hidden="true"></i> Buscar por</h4>

            </div>

            <div class="modal-body">

              <form>

                <div class="form-group">

                    <label>ID</label>

                    <div class="input-group">

                        <span class="input-group-addon">

                            <i class="fa fa-pencil"></i>

                        </span>

                        <input name="id" type="text" value="" class="form-control">

                  </div>

                </div>

                <div class="form-group">

                    <label>Referencia</label>

                    <div class="input-group">

                        <span class="input-group-addon">

                            <i class="fa fa-pencil"></i>

                        </span>

                        <input name="referencia" type="text" value="" class="form-control">

                  </div>

                </div>

                <div class="form-group">

                    <label>Nombre</label>

                    <div class="input-group">

                        <span class="input-group-addon">

                            <i class="fa fa-pencil"></i>

                        </span>

                        <input name="name" type="text" value="" class="form-control">

                  </div>

                </div>

                <form role="form">

                    <div class="form-body">

                       <div class="form-group">

                             <label>Marcas</label>

                             <select name="id_marca" class="form-control">

                                 <option value="">Selecciona una marca</option>

                                <?php foreach ($marcas as $key => $value): ?>

                                     <option value="<?= $value->id ?>"><?= $value->name ?></option>

                                <?php endforeach ?>

                             </select>

                         </div>

                    </div>

                    <div class="form-actions">

                        <div class="row">

                            <div class="col-md-12">

                                <button class="btn dark" type="submit"><i class="fa fa-search" aria-hidden="true"></i> Buscar</button>

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
