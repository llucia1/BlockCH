<?php if ($get_result): ?>

	<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">

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
					<?= $this->Categorias_model->get_parent('categorias',$value->parent) ?> <?= $value->name ?>
				</td>

				<td>

            <div class="btn-group">

                <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                	Acciones
                    <i class="fa fa-angle-down"></i>

                </button>

                <ul class="dropdown-menu" role="menu">

                    <li><?= anchor($lang.'/'.$param.'/edit/'.$value->id, '<span class="fa fa-pencil"></span> Editar ') ?></li>

                    <li><?= anchor($lang.'/'.$param.'/copy/'.$value->id, '<span class="fa fa-files-o"></span> Duplicar ') ?></li>

                    <li><?= anchor($lang.'/'.$param.'/delete/'.$value->id, '<span class="fa fa-trash-o"></span> Borrar ') ?></li>

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
