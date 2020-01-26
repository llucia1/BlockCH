<table class="table table-bordered table-striped table-condensed flip-content">

    <thead class="flip-content">
    <tr>
        <?php foreach ($thead as $th): ?>
            <th width="20%"> <?= $th ?> </th>
        <?php endforeach ?>
        <th width="20%">Acciones</th>
    </tr>
    </thead>

    <tbody>

        <?php foreach ($getResult as $result): ?>

            <tr>
                <td> <?= $result->getId() ?> </td>
                <td> <?= $result->getNombre() ?> </td>
                <td> <?= $result->getTelefono() ?> </td>
                <td> <?= $result->getFalta()->format('d/m/Y') ?> </td>
                <td>
                    <a title="Editar" href="<?= site_url($path.'/edit/'.$result->getId()) ?>" class="btn yellow" type="button"><i class=" icon-pencil "></i></a>

                    <?php if($rol == 1): ?>
                        <a title="Eliminar" href="<?= site_url($path.'/delete/'.$result->getId()) ?>" class="btn red" type="button"><i class="icon-trash "></i></a>
                    <?php endif ?>
                </td>

            </tr>

        <?php endforeach ?>

    </tbody>

</table>