<?php if ($get_result): ?>

	<table class="table table-striped table-hover">

		<thead>

            <tr>

                <th><input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" /></th>

                <?php foreach ($fields as $key => $value): ?>

                     <th> <?= $value ?> </th>

                <?php endforeach ?>

                 <th></th>

            </tr>

        </thead>

        <tbody>

		<?php foreach ($get_result as $key => $value): ?>

			<tr class="odd gradeX">

				<td><input type="checkbox" class="checkboxes" value="1" /></td>

				<td> <?= $value->id ?> </td>

				<td>

					<input name="name" type="text" value="<?= $value->name ?>" key="<?= $value->id ?>" class="form-control md-text" table="<?= strtolower(TABLE) ?>" field="name">

				</td>

				<td>

					<input name="referencia" type="text" value="<?= $value->referencia ?>" key="<?= $value->id ?>" class="form-control md-text" table="<?= strtolower(TABLE) ?>" field="referencia">

				</td>

				<td>
						<?php if(isset($value->nameMarca)): ?>
						
				 			<?= $value->nameMarca ?>
				 			
				 		<?php else: ?>
				 		
				 			Sin Marca
				 			
				 		<?php endif ?>
				</td>

				<td> <?= $value->day ?>/<?= $value->month ?>/<?= $value->year ?> </td>

				<td>

					<input <?php if($value->outstanding == 1) echo 'checked' ?> type="checkbox" class="md-check" id="outstanding" multi="false" key="<?= $value->id  ?>" table="<?= strtolower(TABLE) ?>" field="outstanding">

				</td>

				<td>

					<input <?php if($value->state == 1) echo 'checked' ?> type="checkbox" class="md-check" id="Publicar" multi="false" key="<?= $value->id ?>" table="<?= strtolower(TABLE) ?>" field="state">

				</td>

				<td>

              <div class="btn-group">

                  <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                  	Acciones
                      <i class="fa fa-angle-down"></i>

                  </button>

                  <ul class="dropdown-menu" role="menu">

                      <li><?= anchor($param.'/edit/'.$value->id, '<span class="fa fa-pencil"></span> Editar ') ?></li>

                      <li><?= anchor($param.'/copy/'.$value->id, '<span class="fa fa-files-o"></span> Duplicar ') ?></li>

                      <li><?= anchor($param.'/delete/'.$value->id, '<span class="fa fa-trash-o"></span> Borrar ') ?></li>

                  </ul>

              </div>

          </td>

			</tr>

		<?php endforeach ?>

        </tbody>

	</table>

<?php else: ?>

	<div role="alert" class="alert alert-warning">

        <button data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span><span class="sr-only">Cerrar</span></button>

        <strong><i class="fa fa-warning"></i></strong> Esta sección no tiene datos para mostrar.

    </div>

<?php endif ?>

<div class="pull-right pagination">

<ul class="pagination">

	<?= $pages_links ?>

</ul>
