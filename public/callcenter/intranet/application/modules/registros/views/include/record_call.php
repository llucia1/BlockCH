<table class="table table-bordered table-striped table-condensed flip-content">

    <thead class="flip-content">
    <tr>
        <th width="20%">ID</th>
        <th width="20%">Usuario</th>
        <th width="20%">Fecha</th>
        <th width="20%">Estado</th>
        <th width="20%">Comentario</th>
    </tr>
    </thead>

    <tbody>

        <?php foreach($getRegistroLlamadas as $rll): ?>

            <tr>

                <td> <?= $rll->getId() ?></td>
                <td> <?= $rll->getIdusuario()->getNombre() ?> <?= $rll->getIdusuario()->getApellidos() ?> </td>
                <td> <?= $rll->getStart()->format("d-m-Y") ?> </td>
                <td> <?= $rll->getIdestado()->getNombre() ?> </td>
                <td> <?= $rll->getComentario() ?> </td>

            </tr>

        <?php endforeach ?>

    </tbody>

</table>
