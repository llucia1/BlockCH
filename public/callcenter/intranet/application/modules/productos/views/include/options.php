<div class="col-md-3">

	<div class="portlet light bordered">

		<div class="portlet-title">

			<div class="caption font-dark">

            <i class="fa fa-cogs font-dark"></i>

            <span class="caption-subject bold uppercase"> OPCIONES</span>

        </div>

		</div>

		<div class="portlet-body todo-project-list-content" style="height: auto;">

            <form role="form">

         		<div class="form-group form-md-checkboxes">

                    <div class="md-checkbox-inline">

                        <div class="md-checkbox">

                            <input <?php if($get_row['outstanding'] == 1) echo 'checked' ?> type="checkbox" class="md-check" id="outstanding" multi="false" key="<?= $id ?>" table="<?= strtolower(TABLE) ?>" field="outstanding">

                            <label for="outstanding">
                                <span class="inc"></span>
                                <span class="check"></span>
                                <span class="box"></span> Destacar en home</label>
                        </div>

                    </div>

                </div>

         	</form>

         	<form role="form">

         		<div class="form-group form-md-checkboxes">

                  <div class="md-checkbox-inline">

                      <div class="md-checkbox">

                          <input <?php if($get_row['state'] == 1) echo 'checked' ?> type="checkbox" class="md-check" id="Publicar" multi="false" key="<?= $id ?>" table="<?= strtolower(TABLE) ?>" field="state">

                          <label for="Publicar">
                              <span class="inc"></span>
                              <span class="check"></span>
                              <span class="box"></span> Publicar</label>
                      </div>

                  </div>

              </div>

         	</form>

           <form role="form">

               <div class="form-body">

                  <div class="form-group">

											<i class=" icon-layers font-green"></i>

											<span class="caption-subject font-green bold uppercase">Categoría/s</span>

											<?php if($get_my_categories): ?>
												
												<?php foreach ($get_my_categories as $key => $value): ?>

													<h4 style="padding-top:0; font-size:1em;" class="block"><i class=" icon-layers font-green"></i> <?= $value ?></h4>

												<?php endforeach ?>

											<?php endif ?>

											<button data-toggle="modal" data-target="#categoriasModal" style="width:100%" class="btn btn-success" type="button">Selecciona Categoría</button>

											<hr>

                    </div>

               </div>

           </form>

					 <form role="form">

               <div class="form-body">

                  <div class="form-group">

                        <label>Marcas</label>

                        <select class="form-control md-select" key="<?= $id ?>" table="<?= strtolower(TABLE) ?>" field="id_marca">

                            <option value="0">Selecciona una marca</option>

                           <?php foreach ($marcas as $key => $value): ?>

                                <option <?php if($value->id == $get_row['id_marca']) echo 'selected' ?> value="<?= $value->id ?>"><?= $value->name ?></option>

                           <?php endforeach ?>

                        </select>

                    </div>

               </div>

           </form>

           <form role="form">

               <div class="form-body">

                  <div class="form-group">

                        <label>Precio</label>

                        <input name="price" type="text" value="<?= $get_row['price'] ?>" key="<?= $id ?>" class="form-control md-text" table="<?= strtolower(TABLE) ?>" field="price">

                    </div>

               </div>

           </form>

           <form role="form">

               <div class="form-body">

                  <div class="form-group">

                        <label>Descuento</label>
												<div class="clearfix margin-top-10">

										        <span class="label label-danger">NOTA!</span><br/><br/>
														<p>Ejemplos: 20% | 18.30% | 20 | 18.30</p>

										    </div>

                        <input name="discount" type="text" value="<?= $get_row['discount'] ?><?= $get_row['discount_type'] ?>" key="<?= $id ?>" class="form-control md-text" table="<?= strtolower(TABLE) ?>" field="discount">

                    </div>

               </div>

           </form>

        </div>

	</div>

</div>
