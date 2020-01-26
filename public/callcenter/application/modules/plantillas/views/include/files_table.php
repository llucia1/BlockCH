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

        <?php foreach ($getAttachments as $attachment): ?>

            <tr>
                <td> <?= $attachment->getId() ?> </td>
                <td> <?= $attachment->getAttached() ?> </td>
                <td>
                    <a title="Eliminar" href="<?= site_url($path.'/deleteFile/'.$attachment->getId()) ?>" class="btn red" type="button"><i class="icon-trash "></i></a>
                </td>

            </tr>

        <?php endforeach ?>

    </tbody>

</table>