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

														<input <?php if($get_row['state'] == 1) echo 'checked' ?> type="checkbox" class="md-check" id="Publicar" multi="false" key="<?= $id ?>" table="<?= strtolower(TABLE) ?>" field="state">

														<label for="Publicar">
																<span class="inc"></span>
																<span class="check"></span>
																<span class="box"></span> Activar</label>
												</div>

										</div>

								</div>

					</form>

					<div class="form-group">

							<label>Orden</label>
							<div class="clearfix margin-top-10">

									<span class="label label-danger">NOTA!</span><br/><br/>
									<p>Ordena la posición de la categoría colocando un número, donde 0 es la posición más alta. Si varias categorías tienen asignado el mismo número, la posición se calcula por su ID.</p>

							</div>

							<input name="orden" type="text" value="<?= $get_row['orden'] ?>" key="<?= $id ?>" class="form-control md-text" table="<?= strtolower(TABLE) ?>" field="orden">

					</div>

           <form role="form">

               <div class="form-body">

                  <div class="form-group">

                        <label>Nivel superior</label>

                        <select class="form-control md-select" key="<?= $id ?>" table="<?=  strtolower (TABLE) ?>" field="parent">

                            <option value="0">ningúno</option>

                           <?php foreach ($get_result as $key => $value): ?>

                                <?php if($value->is_join != $id): ?>

                                    <option <?php if( $get_row['parent'] ==  $value->is_join) echo 'selected' ?>   value="<?= $value->is_join ?>"><?= $value->name ?></option>

                                <?php endif ?>

                           <?php endforeach ?>

                        </select>

                    </div>

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
