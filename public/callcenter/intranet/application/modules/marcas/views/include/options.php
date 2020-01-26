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

				<div class="form-group">

						<label>Descuento</label>
						<div class="clearfix margin-top-10">

								<span class="label label-danger">NOTA!</span><br/><br/>
								<p>Ejemplos: 20% | 18.30% | 20 | 18.30</p>

						</div>

						<input name="discount" type="text" value="<?= $get_row['discount'] ?><?= $get_row['discount_type'] ?>" key="<?= $id ?>" class="form-control md-text" table="<?= strtolower(TABLE) ?>" field="discount">

				</div>

         	</form>

        </div>

	</div>

</div>
